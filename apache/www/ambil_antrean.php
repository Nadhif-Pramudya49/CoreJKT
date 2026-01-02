<?php
session_start();
require_once __DIR__ . "/config.php";

$pesan = "";
$faskes = null;
$faskes_id = isset($_GET['faskes_id']) ? (int) $_GET['faskes_id'] : 0;

/* 1. READ DATA FASKES */
if ($faskes_id > 0) {
    // Menggunakan $pdo sesuai dengan code awal Anda
    $stmt = $pdo->prepare("SELECT * FROM faskes WHERE id = ?");
    $stmt->execute([$faskes_id]);
    $faskes = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$faskes) {
        $pesan = "<div class='alert alert-danger shadow-sm'>Fasilitas Kesehatan tidak ditemukan.</div>";
    }
}

/* 2. CREATE ANTREAN BARU */
if (isset($_POST['daftar_antrean']) && $faskes) {
    $nama_pasien = trim($_POST['nama_pasien']);
    $nik = trim($_POST['nik']);
    $tanggal_antrean = date('Y-m-d');

    if ($nama_pasien === "" || $nik === "") {
        $pesan = "<div class='alert alert-warning shadow-sm'>Nama dan NIK wajib diisi.</div>";
    }
    elseif ($faskes['antrean_saat_ini'] >= $faskes['kuota_harian']) {
        $pesan = "<div class='alert alert-danger shadow-sm'>Maaf, kuota harian sudah penuh.</div>";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT MAX(nomor_antrean) FROM antrean WHERE faskes_id = ? AND tanggal_antrean = ?");
            $stmt->execute([$faskes_id, $tanggal_antrean]);
            $nomor_antrean = ($stmt->fetchColumn() ?? 0) + 1;

            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO antrean (faskes_id, nama_pasien, nik, tanggal_antrean, nomor_antrean) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$faskes_id, $nama_pasien, $nik, $tanggal_antrean, $nomor_antrean]);

            $stmt = $pdo->prepare("UPDATE faskes SET antrean_saat_ini = antrean_saat_ini + 1 WHERE id = ?");
            $stmt->execute([$faskes_id]);

            $pdo->commit();

            $_SESSION['nomor_antrean'] = $nomor_antrean;
            $_SESSION['faskes_nama'] = $faskes['nama'];

            header("Location: status_antrean.php");
            exit();

        } catch (Exception $e) {
            $pdo->rollBack();
            $pesan = "<div class='alert alert-danger shadow-sm'>Terjadi kesalahan sistem. Silakan coba lagi.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Ambil Antrean - <?php echo $faskes ? $faskes['nama'] : 'Faskes'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />

    <style>
        body { background-color: #f4f7f9; }
        
        /* Tema Biru Tua */
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
            border-bottom: 5px solid var(--blue-dark);
        }

        .antrean-form-card {
            max-width: 600px;
            margin: 0 auto;
            border: none;
            border-radius: 15px;
        }

        /* Warna Teks Putih pada background Biru */
        .btn-submit {
            background-color: var(--blue-soft);
            border-color: var(--blue-soft);
            color: white !important;
            font-weight: 600;
            padding: 12px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background-color: var(--blue-dark);
            border-color: var(--blue-dark);
            transform: translateY(-2px);
        }

        .btn-back {
            background-color: transparent;
            border: 2px solid var(--blue-soft);
            color: var(--blue-soft) !important;
            font-weight: 600;
        }

        .btn-back:hover {
            background-color: var(--blue-soft);
            color: white !important;
        }

        .faskes-info-box {
            background-color: #eef2f7;
            border-left: 5px solid var(--blue-soft);
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">LAYANAN KESEHATAN DIGITAL</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="antrean_faskes.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Antrean Faskes</a>
            </div>
        </div>
    </nav>

    <div class="page-header text-center shadow-sm">
        <div class="container">
            <i class="fas fa-hospital-user fa-3x mb-3"></i>
            <h1 class="fw-bold">Pendaftaran Antrean</h1>
            <p class="lead mb-0">Silakan lengkapi data pasien untuk mendapatkan nomor antrean digital.</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <?php echo $pesan; ?>

                <?php if ($faskes): ?>
                    <div class="card antrean-form-card shadow-lg p-4">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold" style="color: var(--blue-dark);">Formulir Pendaftaran</h3>
                            <div class="faskes-info-box mt-3">
                                <h5 class="mb-1 fw-bold"><?php echo $faskes['nama']; ?></h5>
                                <p class="small text-muted mb-0"><i class="fas fa-map-marker-alt me-1"></i> <?php echo $faskes['alamat']; ?></p>
                            </div>
                        </div>

                        <form method="POST">
                            <input type="hidden" name="faskes_id" value="<?php echo $faskes_id; ?>">

                            <div class="mb-3">
                                <label for="nama_pasien" class="form-label fw-bold">Nama Lengkap Pasien</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                                    <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" placeholder="Masukkan nama sesuai KTP" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="nik" class="form-label fw-bold">Nomor Induk Kependudukan (NIK)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-id-card text-muted"></i></span>
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="16 Digit NIK" required maxlength="16">
                                </div>
                                <div id="nikHelp" class="form-text">Data NIK digunakan untuk validasi pasien di lokasi.</div>
                            </div>

                            <div class="alert alert-info border-0 d-flex align-items-center mb-4" style="background-color: #e3f2fd;">
                                <i class="fas fa-info-circle fa-2x me-3 text-primary"></i>
                                <div>
                                    <small class="d-block">Sisa Kuota Hari Ini:</small>
                                    <strong class="fs-5"><?php echo $faskes['kuota_harian'] - $faskes['antrean_saat_ini']; ?></strong> 
                                    <span class="text-muted">/ <?php echo $faskes['kuota_harian']; ?> Pasien</span>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" name="daftar_antrean" class="btn btn-submit btn-lg">
                                    <i class="fas fa-check-circle me-2"></i> Konfirmasi & Ambil Antrean
                                </button>
                                <a href="antrean_faskes.php" class="btn btn-back btn-lg mt-2">
                                    <i class="fas fa-times me-2"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="text-center mt-5">
                        <a href="antrean_faskes.php" class="btn btn-primary px-4 py-2">Kembali ke Daftar Faskes</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            &copy; 2025 CoreJKT - Sistem Informasi Layanan Masyarakat Jakarta..
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>