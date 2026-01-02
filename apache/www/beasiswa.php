<?php
session_start();
require_once __DIR__ . "/config.php";

// Data Simulasi Beasiswa Aktif
$beasiswa_list = [
    [
        "nama" => "KJP Plus Tahap II",
        "kategori" => "Bantuan Sekolah",
        "sasaran" => "SD, SMP, SMA/SMK",
        "status" => "Pendaftaran Dibuka",
        "deadline" => "15 Januari 2026",
        "deskripsi" => "Bantuan biaya operasional pendidikan bagi warga DKI Jakarta dari keluarga tidak mampu."
    ],
    [
        "nama" => "KJMU (Kartu Jakarta Mahasiswa Unggul)",
        "kategori" => "Pendidikan Tinggi",
        "sasaran" => "Mahasiswa D3/D4/S1",
        "status" => "Verifikasi Data",
        "deadline" => "30 Januari 2026",
        "deskripsi" => "Beasiswa penuh untuk lulusan SMA/SMK Jakarta yang kuliah di PTN seluruh Indonesia."
    ],
    [
        "nama" => "Beasiswa Jakarta (Yayasan Beasiswa Jakarta)",
        "kategori" => "Prestasi",
        "sasaran" => "Mahasiswa Semester 2-6",
        "status" => "Segera Hadir",
        "deadline" => "Maret 2026",
        "deskripsi" => "Bantuan biaya pendidikan bagi mahasiswa berprestasi yang berdomisili di Jakarta."
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Info Beasiswa - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body { background-color: #f8f9fa; }
        
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 60px 0;
            border-bottom: 5px solid #ffc107;
        }

        .scholarship-card {
            border: none;
            border-radius: 20px;
            transition: 0.3s;
            background: white;
            border-top: 5px solid transparent;
        }

        .scholarship-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            border-top: 5px solid #ffc107;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }

        .btn-apply {
            background-color: var(--blue-soft);
            color: white;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-apply:hover {
            background-color: var(--blue-dark);
            color: white;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: #fff3cd;
            color: #856404;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
            <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
            <span class="brand-text fw-bold">BEASISWA JAKARTA</span>
        </a>
        <div class="ms-auto">
            <a href="pendidikan.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</nav>

<header class="page-header text-center">
    <div class="container">
        <div class="icon-box mx-auto mb-3 shadow-sm">
            <i class="fas fa-hand-holding-heart"></i>
        </div>
        <h1 class="fw-bold">Wujudkan Mimpimu dengan Beasiswa</h1>
        <p class="lead">Informasi bantuan biaya pendidikan resmi dari Pemerintah Provinsi DKI Jakarta.</p>
    </div>
</header>

<div class="container my-5">
    <div class="row mb-5 justify-content-center">
        <div class="col-md-8 text-center">
            <div class="bg-white p-3 rounded-pill shadow-sm d-flex gap-2">
                <input type="text" class="form-control border-0 px-4" placeholder="Cari nama beasiswa (KJP, KJMU, dll)...">
                <button class="btn btn-warning rounded-pill px-4 fw-bold">Cari</button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php foreach ($beasiswa_list as $b): ?>
        <div class="col-lg-4 col-md-6">
            <div class="card scholarship-card h-100 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="text-muted small fw-bold text-uppercase"><?= $b['kategori'] ?></span>
                    <span class="status-badge <?= $b['status'] == 'Pendaftaran Dibuka' ? 'bg-success text-white' : 'bg-warning text-dark' ?>">
                        <?= $b['status'] ?>
                    </span>
                </div>

                <h4 class="fw-bold mb-2" style="color: var(--blue-dark);"><?= $b['nama'] ?></h4>
                <p class="small text-secondary mb-4"><?= $b['deskripsi'] ?></p>

                <div class="mt-auto">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-users text-muted me-2"></i>
                        <small>Sasaran: <strong><?= $b['sasaran'] ?></strong></small>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-calendar-alt text-muted me-2"></i>
                        <small>Batas Akhir: <span class="text-danger fw-bold"><?= $b['deadline'] ?></span></small>
                    </div>
                    <a href="#" class="btn btn-apply w-100">Lihat Detail & Daftar</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="alert bg-white border-0 shadow-sm rounded-4 p-4 border-start border-warning border-5">
                <div class="row align-items-center">
                    <div class="col-md-1">
                        <i class="fas fa-question-circle fa-3x text-warning"></i>
                    </div>
                    <div class="col-md-11">
                        <h5 class="fw-bold mb-1">Belum menemukan beasiswa yang cocok?</h5>
                        <p class="text-muted mb-0 small">Kunjungi kantor Dinas Pendidikan atau hubungi call center bantuan pendidikan di (021) 1234567 untuk konsultasi bantuan biaya pendidikan lainnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-white border-top mt-5 text-center text-muted small">
    <div class="container">
        &copy; 2025 CoreJKT - Layanan Inklusi Pendidikan DKI Jakarta.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>