<?php
session_start();
require_once __DIR__ . "/config.php";

$nomor_antrean = $_SESSION['nomor_antrean'] ?? null;
$faskes_nama   = $_SESSION['faskes_nama'] ?? null;

$antrean_data = null;
$antrean_id   = null;
$pesan        = "";

/* 1. AMBIL DATA ANTREAN */
if ($nomor_antrean && $faskes_nama) {
    $stmt = $pdo->prepare("
        SELECT a.*, f.nama AS faskes_nama, f.antrean_saat_ini, f.alamat AS faskes_alamat
        FROM antrean a
        JOIN faskes f ON a.faskes_id = f.id
        WHERE a.nomor_antrean = ? 
          AND f.nama = ? 
          AND a.tanggal_antrean = CURDATE()
        ORDER BY a.id DESC
        LIMIT 1
    ");
    $stmt->execute([$nomor_antrean, $faskes_nama]);
    $antrean_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($antrean_data) {
        $antrean_id = $antrean_data['id'];
    }
}

/* 2. BATALKAN ANTREAN */
if (isset($_POST['batalkan_antrean']) && $antrean_id) {
    try {
        $pdo->beginTransaction();
        $stmt = $pdo->prepare("UPDATE antrean SET status = 'Batal' WHERE id = ?");
        $stmt->execute([$antrean_id]);

        $stmt = $pdo->prepare("UPDATE faskes SET antrean_saat_ini = antrean_saat_ini - 1 WHERE id = ?");
        $stmt->execute([$antrean_data['faskes_id']]);

        $pdo->commit();
        unset($_SESSION['nomor_antrean'], $_SESSION['faskes_nama']);
        $pesan = "<div class='alert alert-warning text-center shadow-sm'>Antrean Anda telah berhasil dibatalkan.</div>";
        $antrean_data = null;
    } catch (Exception $e) {
        $pdo->rollBack();
        $pesan = "<div class='alert alert-danger text-center shadow-sm'>Gagal membatalkan antrean. Silakan coba lagi.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Antrean - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body { background-color: #f4f7f9; }
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
            border-bottom: 5px solid var(--blue-dark);
        }
        .status-card {
            max-width: 550px;
            margin: 0 auto;
            border: none;
            border-radius: 20px;
            background: #fff;
        }
        .ticket-top {
            background-color: var(--blue-dark);
            color: white;
            padding: 20px;
            border-radius: 20px 20px 0 0;
        }
        .antrean-number {
            font-size: 6rem;
            font-weight: 800;
            color: var(--blue-soft);
            line-height: 1;
            margin: 20px 0;
            letter-spacing: -2px;
        }
        .info-row {
            border-top: 1px dashed #ddd;
            padding: 15px 0;
        }
        .btn-home {
            background-color: var(--blue-soft);
            color: white !important;
            font-weight: 600;
        }
        .btn-home:hover { background-color: var(--blue-dark); }
        
        .btn-batal-outline {
            color: #dc3545;
            border: 1px solid #dc3545;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-batal-outline:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Dekorasi Lingkaran Karcis */
        .ticket-body {
            position: relative;
            padding: 30px;
        }
        .ticket-body::before, .ticket-body::after {
            content: "";
            position: absolute;
            top: -15px;
            width: 30px;
            height: 30px;
            background-color: #f4f7f9;
            border-radius: 50%;
        }
        .ticket-body::before { left: -15px; }
        .ticket-body::after { right: -15px; }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
            <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
            <span class="brand-text fw-bold">COREJKT</span>
        </a>
        <div class="ms-auto">
            <a href="dashboard.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="fas fa-home me-1"></i> Dashboard
            </a>
        </div>
    </div>
</nav>

<div class="page-header text-center">
    <div class="container">
        <i class="fas fa-ticket-alt fa-3x mb-3"></i>
        <h1 class="fw-bold">Status Antrean Digital</h1>
        <p class="lead mb-0">Pantau nomor antrean Anda secara real-time.</p>
    </div>
</div>

<div class="container pb-5">
    <?= $pesan ?>

    <?php if ($antrean_data): ?>
        <div class="card status-card shadow-lg text-center">
            <div class="ticket-top">
                <h5 class="mb-0 fw-bold"><i class="fas fa-hospital me-2"></i> Karcis Antrean</h5>
                <small class="opacity-75">Provinsi DKI Jakarta</small>
            </div>
            
            <div class="ticket-body">
                <p class="text-uppercase tracking-wider text-muted mb-0 fw-bold small">Nomor Antrean Anda</p>
                <div class="antrean-number">
                    <?= str_pad($antrean_data['nomor_antrean'], 3, "0", STR_PAD_LEFT); ?>
                </div>

                <div class="mb-4">
                    <h4 class="fw-bold mb-1" style="color: var(--blue-dark);"><?= $antrean_data['faskes_nama']; ?></h4>
                    <p class="text-muted small"><i class="fas fa-map-marker-alt me-1"></i> <?= $antrean_data['faskes_alamat']; ?></p>
                </div>

                <div class="info-row d-flex justify-content-between text-start">
                    <div>
                        <small class="text-muted d-block">Nama Pasien</small>
                        <span class="fw-bold"><?= $antrean_data['nama_pasien']; ?></span>
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block">Status</small>
                        <span class="badge bg-info"><?= $antrean_data['status']; ?></span>
                    </div>
                </div>

                <div class="info-row d-flex justify-content-between text-start mb-4">
                    <div>
                        <small class="text-muted d-block">Tanggal</small>
                        <span class="fw-bold"><?= date('d M Y', strtotime($antrean_data['tanggal_antrean'])); ?></span>
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block">Waktu Ambil</small>
                        <span class="fw-bold"><?= date('H:i', strtotime($antrean_data['waktu_buat'])); ?> WIB</span>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button onclick="window.print()" class="btn btn-home btn-lg">
                        <i class="fas fa-print me-2"></i> Cetak Nomor Antrean
                    </button>
                    
                    <form method="POST" class="mt-2">
                        <button type="submit" name="batalkan_antrean" 
                                class="btn btn-batal-outline w-100 py-2"
                                onclick="return confirm('Apakah Anda yakin ingin membatalkan antrean ini?')">
                            <i class="fas fa-times-circle me-1"></i> Batalkan Antrean
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p class="text-muted small">
                <i class="fas fa-info-circle me-1"></i> 
                Silakan datang 15 menit sebelum jam operasional dimulai.
            </p>
        </div>

    <?php else: ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-5 text-center rounded-4">
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <h4 class="fw-bold">Tidak Ada Antrean Aktif</h4>
                    <p class="text-muted">Anda belum memiliki atau telah membatalkan antrean untuk hari ini.</p>
                    <a href="antrean_faskes.php" class="btn btn-home mt-3 px-4">
                        <i class="fas fa-plus me-2"></i> Ambil Antrean Baru
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<footer class="py-4 bg-white border-top mt-5">
    <div class="container text-center text-muted small">
        &copy; 2025 CoreJKT - Layanan Kesehatan Masyarakat DKI Jakarta.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>