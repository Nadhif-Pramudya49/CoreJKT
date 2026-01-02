<?php
session_start();
require_once __DIR__ . "/config.php";

// 1. CEK LOGIN
if (!isset($_SESSION["user"]["id"])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION["user"]["id"];
$pesan = "";
$messageType = "success";

// 2. LOGIKA PENGIRIMAN LAPORAN
if (isset($_POST['kirim_aduan'])) {
    $jenis = trim($_POST['jenis'] ?? "");
    $sekolah = trim($_POST['sekolah'] ?? "");
    $deskripsi = trim($_POST['deskripsi'] ?? "");
    $tiket_id = "EDU-" . rand(1000, 9999);

    if (empty($jenis) || empty($sekolah) || empty($deskripsi)) {
        $pesan = "Semua field wajib diisi!";
        $messageType = "danger";
    } else {
        $foto_name = "";
        if (!empty($_FILES['bukti']['name'])) {
            $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];
            $file_ext = strtolower(pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION));

            if (in_array($file_ext, $allowed_ext) && $_FILES['bukti']['size'] <= 5242880) {
                if (!file_exists("uploads"))
                    mkdir("uploads", 0777, true);
                $foto_name = "LAPOR_" . time() . "_" . uniqid() . "." . $file_ext;
                move_uploaded_file($_FILES['bukti']['tmp_name'], "uploads/" . $foto_name);
            }
        }

        try {
            $sql = "INSERT INTO laporan_sekolah (id_user, tiket_id, jenis_pelanggaran, nama_sekolah, deskripsi, bukti_foto, status, tanggal_lapor) 
                    VALUES (:id_user, :tiket, :jenis, :sekolah, :deskripsi, :bukti, 'pending', NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id_user' => $id_user,
                ':tiket' => $tiket_id,
                ':jenis' => $jenis,
                ':sekolah' => $sekolah,
                ':deskripsi' => $deskripsi,
                ':bukti' => $foto_name
            ]);
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1&t=" . $tiket_id);
            exit;
        } catch (PDOException $e) {
            $pesan = "Gagal menyimpan ke database: " . $e->getMessage();
            $messageType = "danger";
        }
    }
}

if (isset($_GET['success'])) {
    $t = htmlspecialchars($_GET['t']);
    $pesan = "<div class='alert alert-success border-0 shadow-sm animate__animated animate__fadeIn'><i class='fas fa-check-circle me-2'></i> Laporan diterima. Tiket: <strong>#$t</strong></div>";
}

try {
    $sql_list = "SELECT * FROM laporan_sekolah WHERE id_user = :id_user ORDER BY tanggal_lapor DESC LIMIT 5";
    $stmt_list = $pdo->prepare($sql_list);
    $stmt_list->execute([':id_user' => $id_user]);
    $laporan_list = $stmt_list->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $laporan_list = [];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Layanan Pengaduan Sekolah - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        :root {
            --primary-red: #dc3545;
            --dark-blue: #051025;
            --light-bg: #f8f9fc;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Inter', -apple-system, sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: var(--dark-blue) !important;
            backdrop-filter: blur(10px);
        }

        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, var(--primary-red) 0%, #a71d2a 100%);
            color: white;
            padding: 80px 0;
            border-bottom: 5px solid rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .page-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transform: translate(150px, -150px);
        }

        /* Card Styles */
        .report-card {
            margin-top: -60px;
            border: none;
            border-radius: 24px;
            background: white;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .side-card {
            border: none;
            border-radius: 24px;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        }

        /* Input Styles */
        .form-control,
        .form-select {
            border: 2px solid #edf2f7;
            border-radius: 12px;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-red);
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
        }

        /* Button Styles */
        .btn-report {
            background: var(--primary-red);
            color: white;
            font-weight: 700;
            border-radius: 12px;
            padding: 15px;
            border: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s;
        }

        .btn-report:hover {
            background: #b02a37;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(220, 53, 69, 0.3);
            color: white;
        }

        /* Badge & Alerts */
        .status-badge {
            font-size: 0.7rem;
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .anonymous-alert {
            background-color: #fffaf0;
            border: 1px solid #feebc8;
            border-left: 5px solid #ed8936;
            color: #7b341e;
            border-radius: 15px;
        }

        /* History Items */
        .history-item {
            border-radius: 16px;
            transition: background 0.2s;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .history-item:hover {
            background-color: #f8fafc;
        }

        .history-icon {
            width: 35px;
            height: 35px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-blue);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
                <span class="brand-text fw-bold">PENGADUAN SEKOLAH</span>
            </a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="pendidikan.php" class="btn btn-outline-light btn-sm rounded-pill px-3 shadow-sm"
                    style="border-width: 2px; font-weight: 600;">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>

                <div
                    class="bg-white bg-opacity-10 px-3 py-1 rounded-pill text-white small border border-white border-opacity-25">
                    <i class="fas fa-user-circle me-2"></i><?= htmlspecialchars($_SESSION["user"]["nama"] ?? "User") ?>
                </div>
            </div>
        </div>
    </nav>

    <header class="page-header text-center">
        <div class="container animate__animated animate__fadeIn">
            <i class="fas fa-shield-alt fa-4x mb-3"></i>
            <h1 class="fw-bold display-5">WBS CoreJKT</h1>
            <p class="lead opacity-90">Laporkan Pungli & Gratifikasi secara aman dan terlindungi.</p>
        </div>
    </header>

    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card report-card shadow-lg p-4 p-md-5 animate__animated animate__slideInUp">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                            <i class="fas fa-pen-nib text-danger"></i>
                        </div>
                        <h3 class="fw-bold mb-0">Buat Laporan Baru</h3>
                    </div>

                    <?= $pesan ?>

                    <div class="anonymous-alert p-3 mb-4 small shadow-sm">
                        <div class="d-flex">
                            <i class="fas fa-user-secret fa-2x me-3 opacity-50"></i>
                            <div>
                                <strong>Privasi Terjamin</strong><br>
                                Identitas Anda dienkripsi oleh sistem. Laporan akan diproses secara objektif tanpa
                                mengungkap pelapor.
                            </div>
                        </div>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted small">Kategori Pelanggaran</label>
                                <select class="form-select" name="jenis" required>
                                    <option value="">Pilih Kategori...</option>
                                    <option value="Pungli">Pungutan Liar (Pungli)</option>
                                    <option value="Gratifikasi">Gratifikasi / Suap</option>
                                    <option value="Bullying">Bullying / Kekerasan</option>
                                    <option value="Fasilitas">Penyalahgunaan Fasilitas</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-muted small">Nama Instansi/Sekolah</label>
                                <input type="text" class="form-control" name="sekolah"
                                    placeholder="Contoh: SMPN 1 Jakarta" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted small">Kronologi Kejadian</label>
                            <textarea class="form-control" name="deskripsi" rows="5"
                                placeholder="Jelaskan apa, siapa, kapan, dan di mana..." required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-muted small">Unggah Bukti (Opsional)</label>
                            <div class="bg-light p-3 rounded-3 border-dashed text-center">
                                <input type="file" class="form-control" name="bukti">
                                <div class="form-text mt-2 small">Format: JPG, PNG, PDF (Maks. 5MB)</div>
                            </div>
                        </div>

                        <button type="submit" name="kirim_aduan" class="btn btn-report w-100 shadow">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Laporan Sekarang
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card side-card shadow-sm p-4 animate__animated animate__fadeInRight">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Status Aduan</h5>
                        <span class="badge bg-light text-dark rounded-pill px-3"><?= count($laporan_list) ?>
                            Terakhir</span>
                    </div>

                    <?php if (empty($laporan_list)): ?>
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-light mb-3"></i>
                            <p class="text-muted">Belum ada aktivitas pelaporan.</p>
                        </div>
                    <?php else: ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($laporan_list as $item):
                                $badge = match ($item['status']) {
                                    'pending' => 'bg-warning text-dark',
                                    'diproses' => 'bg-info text-white',
                                    'selesai' => 'bg-success text-white',
                                    'ditolak' => 'bg-danger text-white',
                                    default => 'bg-secondary'
                                };
                                ?>
                                <div class="list-group-item px-0 py-3 history-item border-0">
                                    <div class="d-flex align-items-start">
                                        <div class="history-icon me-3">
                                            <i class="fas fa-file-invoice"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="fw-bold small">#<?= $item['id_laporan'] ?></span>
                                                <span class="status-badge <?= $badge ?>"><?= $item['status'] ?></span>
                                            </div>
                                            <div class="fw-bold text-dark small mb-1">
                                                <?= htmlspecialchars($item['nama_sekolah']) ?>
                                            </div>
                                            <div class="text-muted" style="font-size: 0.75rem;">
                                                <i class="far fa-clock me-1"></i>
                                                <?= date('d M Y', strtotime($item['tanggal_lapor'])) ?>
                                                <span class="mx-1">•</span>
                                                <i class="fas fa-hashtag me-1"></i>
                                                <?= htmlspecialchars($item['jenis_pelanggaran']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center mt-4">
                            <a href="riwayat_lengkap.php"
                                class="btn btn-light btn-sm w-100 rounded-3 py-2 fw-bold text-muted">
                                <i class="fas fa-list-ul me-2"></i> Lihat Semua Riwayat
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card mt-4 border-0 rounded-4 bg-dark text-white p-4 overflow-hidden position-relative">
                    <div class="position-relative z-1">
                        <h6 class="fw-bold mb-2">Butuh Bantuan?</h6>
                        <p class="small opacity-75 mb-3">Hubungi hotline kami jika Anda mengalami kesulitan dalam
                            melapor.</p>
                        <a href="tel:112" class="btn btn-danger btn-sm rounded-pill px-4">Call Center 112</a>
                    </div>
                    <i class="fas fa-headset position-absolute end-0 bottom-0 opacity-10 m-n3"
                        style="font-size: 8rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5 bg-white border-top text-center text-muted">
        <div class="container">
            <div class="mb-3">
                <img src="assets/Logo1.png" alt="Logo" style="height: 30px; opacity: 0.5;">
            </div>
            <div class="small">
                &copy; 2025 <strong>CoreJKT</strong> - Inspektorat Dinas Pendidikan Provinsi DKI Jakarta.<br>
                Sistem Pengaduan Pelanggaran Integritas Lingkungan Sekolah.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>