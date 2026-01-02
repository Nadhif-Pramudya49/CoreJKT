<?php
session_start();
require_once __DIR__ . "/config.php";

$hasil_cek = null;
$pesan = "";

// Simulasi Logika Cek BPJS (Backend)
if (isset($_POST['proses_cek'])) {
    $nomor_input = trim($_POST['nomor_kepesertaan']);
    
    // Simulasi database/API BPJS
    if (strlen($nomor_input) < 13) {
        $pesan = "<div class='alert alert-danger shadow-sm'>Format nomor tidak valid. Masukkan 13 digit nomor kartu atau 16 digit NIK.</div>";
    } else {
        // Data simulasi untuk demo
        $hasil_cek = [
            "nama" => "Fulan bin Fulan",
            "nomor" => $nomor_input,
            "status" => "AKTIF",
            "jenis" => "Pekerja Penerima Upah (PPU)",
            "faskes" => "Puskesmas Tanah Abang",
            "tunggakan" => "Rp 0,-"
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Status BPJS Kesehatan - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body { background-color: #f4f7f6; }
        
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 50px 0;
            border-bottom: 5px solid var(--blue-dark);
        }

        .cek-card {
            margin-top: -50px;
            border: none;
            border-radius: 20px;
            background: white;
        }

        .btn-cek {
            background-color: var(--blue-soft);
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 12px;
        }

        .btn-cek:hover {
            background-color: var(--blue-dark);
            color: white;
        }

        .result-box {
            border-top: 2px dashed #dee2e6;
            margin-top: 25px;
            padding-top: 25px;
        }

        .status-aktif { color: #198754; font-weight: 800; }
        .status-nonaktif { color: #dc3545; font-weight: 800; }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f8f9fa;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">Integrasi Layanan Jaminan Kesehatan Jakarta.</span>
            </a>
        <div class="ms-auto">
            <a href="kesehatan.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</nav>

<header class="page-header text-center">
    <div class="container">
        <i class="fas fa-id-card-alt fa-3x mb-3"></i>
        <h1 class="fw-bold">Layanan Mandiri BPJS Kesehatan</h1>
        <p class="lead">Cek status aktif kepesertaan dan informasi fasilitas kesehatan tingkat pertama Anda.</p>
    </div>
</header>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card cek-card shadow-lg p-4 p-md-5">
                <h4 class="fw-bold text-center mb-4" style="color: var(--blue-dark);">Cek Kepesertaan</h4>
                
                <?= $pesan ?>

                <form method="POST" action="">
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Nomor Kartu BPJS / NIK</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="nomor_kepesertaan" class="form-control border-start-0 py-2" placeholder="Contoh: 0001234567890" required>
                        </div>
                        <div class="form-text mt-2 small">Data Anda terlindungi dan hanya digunakan untuk verifikasi status.</div>
                    </div>
                    
                    <button type="submit" name="proses_cek" class="btn btn-cek w-100">
                        <i class="fas fa-sync-alt me-2"></i> Periksa Sekarang
                    </button>
                </form>

                <?php if ($hasil_cek): ?>
                <div class="result-box">
                    <div class="text-center mb-4">
                        <p class="mb-0 text-muted small">STATUS KEPESERTAAN</p>
                        <h2 class="status-aktif"><?= $hasil_cek['status'] ?></h2>
                    </div>

                    <div class="info-row">
                        <span class="text-muted small">Nama Peserta</span>
                        <span class="fw-bold"><?= $hasil_cek['nama'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="text-muted small">Nomor Kartu/NIK</span>
                        <span class="fw-bold"><?= $hasil_cek['nomor'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="text-muted small">Jenis Peserta</span>
                        <span class="fw-bold"><?= $hasil_cek['jenis'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="text-muted small">Faskes Tingkat I</span>
                        <span class="fw-bold"><?= $hasil_cek['faskes'] ?></span>
                    </div>
                    <div class="info-row mb-4">
                        <span class="text-muted small">Total Tunggakan</span>
                        <span class="fw-bold text-success"><?= $hasil_cek['tunggakan'] ?></span>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="peta_faskes.php" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-map-marker-alt me-2"></i> Cari Faskes Terdekat
                        </a>
                        <button onclick="window.print()" class="btn btn-light btn-sm text-muted">
                            <i class="fas fa-print me-2"></i> Cetak Bukti Status
                        </button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="bg-white p-4 rounded-4 shadow-sm border-start border-primary border-5">
                <div class="d-flex align-items-start">
                    <i class="fas fa-info-circle fa-2x text-primary me-3 mt-1"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Kenapa Status Tidak Aktif?</h6>
                        <p class="small text-muted mb-0">Status kepesertaan bisa menjadi tidak aktif jika terdapat tunggakan iuran, pindah jenis kepesertaan, atau data belum tervalidasi. Harap hubungi Pandawa BPJS di 08118750400 untuk bantuan lebih lanjut.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-white border-top mt-auto text-center text-muted small">
    <div class="container">
        &copy; 2025 CoreJKT - Integrasi Layanan Jaminan Kesehatan Jakarta.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>