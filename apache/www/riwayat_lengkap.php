<?php
// ... (Bagian PHP tetap sama seperti sebelumnya)
session_start();
require_once __DIR__ . "/config.php";

if (!isset($_SESSION["user"]["id"])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION["user"]["id"];
$pesan = "";

if (isset($_POST['hapus_laporan'])) {
    $id_laporan = $_POST['id_laporan'];
    try {
        $sql_delete = "DELETE FROM laporan_sekolah WHERE id_laporan = :id AND id_user = :uid";
        $stmt_del = $pdo->prepare($sql_delete);
        $stmt_del->execute([':id' => $id_laporan, ':uid' => $id_user]);
        header("Location: riwayat_lengkap.php?deleted=1");
        exit;
    } catch (PDOException $e) {
        $pesan = "Gagal menghapus: " . $e->getMessage();
    }
}

try {
    $sql = "SELECT * FROM laporan_sekolah WHERE id_user = :id_user ORDER BY tanggal_lapor DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id_user' => $id_user]);
    $laporan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan Saya - CoreJKT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #dc3545;
            --dark-blue: #051025;
            --soft-bg: #f4f7f9;
        }

        body {
            background-color: var(--soft-bg);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* Header Style */
        .page-header {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #1a2a44 100%);
            padding: 60px 0 100px;
            color: white;
            text-align: center;
            margin-bottom: -60px;
        }

        .container {
            position: relative;
            z-index: 10;
        }

        /* Card Wrapper */
        .main-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 50px;
        }

        /* Table Styling */
        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table thead th {
            background-color: transparent;
            color: #6c757d;
            border: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
            padding: 15px;
        }

        .table tbody tr {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            border-radius: 15px;
        }

        .table tbody tr:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            background-color: #fff;
        }

        .table tbody td {
            padding: 20px 15px;
            border: none;
            vertical-align: middle;
        }

        .table tbody td:first-child {
            border-radius: 15px 0 0 15px;
        }

        .table tbody td:last-child {
            border-radius: 0 15px 15px 0;
        }

        /* Badge Status Custom */
        .badge-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.7rem;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        /* Image Preview */
        .img-wrapper {
            position: relative;
            display: inline-block;
            overflow: hidden;
            border-radius: 12px;
            width: 70px;
            height: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .img-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .img-wrapper:hover .img-preview {
            transform: scale(1.2);
        }

        /* Buttons */
        .btn-action-delete {
            background: #fff;
            color: #dc3545;
            border: 1px solid #f8d7da;
            padding: 8px 12px;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-action-delete:hover {
            background: #dc3545;
            color: white;
        }

        .btn-custom-back {
            background: var(--dark-blue);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-custom-back:hover {
            background: var(--primary-red);
            color: white;
            transform: translateX(-5px);
        }
    </style>
</head>

<body>

    <header class="page-header">
        <div class="container">
            <h1 class="fw-bold"><i class="fas fa-history me-3"></i>Arsip Pengaduan</h1>
            <p class="opacity-75">Pantau dan kelola laporan yang telah Anda kirimkan ke Inspektorat</p>
        </div>
    </header>

    <div class="container">
        <div class="main-card">

            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> Laporan berhasil dihapus secara permanen.
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Informasi Laporan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Waktu</th>
                            <th class="text-center">Lampiran</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($laporan_list)): ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/gray/empty-folder.svg" alt="empty"
                                        style="width: 150px;" class="mb-3">
                                    <p class="text-muted">Belum ada data laporan yang tersedia.</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($laporan_list as $l): ?>
                                <tr>
                                    <td class="text-center fw-bold text-muted"><?= $no++; ?></td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($l['jenis_pelanggaran']); ?></div>
                                        <div class="small text-muted"><i class="fas fa-school me-1"></i>
                                            <?= htmlspecialchars($l['nama_sekolah']); ?></div>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $bg = match ($l['status']) {
                                            'pending' => 'bg-warning text-dark',
                                            'diproses' => 'bg-info text-white',
                                            'selesai' => 'bg-success text-white',
                                            'ditolak' => 'bg-danger text-white',
                                            default => 'bg-secondary text-white'
                                        };
                                        ?>
                                        <span class="badge-status <?= $bg ?>"><?= strtoupper($l['status']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="small fw-bold"><?= date('d M Y', strtotime($l['tanggal_lapor'])); ?></div>
                                        <div class="text-muted small"><?= date('H:i', strtotime($l['tanggal_lapor'])); ?> WIB
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if (!empty($l['bukti_foto'])): ?>
                                            <div class="img-wrapper">
                                                <a href="uploads/<?= $l['bukti_foto'] ?>" target="_blank">
                                                    <img src="uploads/<?= $l['bukti_foto'] ?>" class="img-preview" alt="Bukti">
                                                </a>
                                            </div>
                                        <?php else: ?>
                                            <i class="fas fa-image text-light fa-2x"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <form method="POST" onsubmit="return confirm('Hapus laporan ini secara permanen?');">
                                            <input type="hidden" name="id_laporan" value="<?= $l['id_laporan'] ?>">
                                            <button type="submit" name="hapus_laporan" class="btn-action-delete shadow-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-center">
            <a href="lapor_sekolah.php" class="btn-custom-back shadow">
                <i class="fas fa-long-arrow-alt-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>