<?php
session_start();
require_once __DIR__ . "/config.php";

$hasil_seleksi = null;
$pesan = "";

// Simulasi Logika Cek Status Seleksi PPDB
if (isset($_POST['cek_status'])) {
    $nomor_peserta = trim($_POST['nomor_peserta']);
    
    // Validasi sederhana (Simulasi)
    if (strlen($nomor_peserta) < 10) {
        $pesan = "<div class='alert alert-danger shadow-sm'>Nomor peserta tidak valid. Masukkan minimal 10 digit nomor pendaftaran.</div>";
    } else {
        // Data simulasi hasil seleksi
        $hasil_seleksi = [
            "nama" => "Andi Wijaya",
            "sekolah_tujuan" => "SMA Negeri 1 Jakarta",
            "jalur" => "Zonasi",
            "status" => "DITERIMA",
            "skor" => "88.50",
            "posisi" => "12 dari 120"
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PPDB Online Jakarta - CoreJKT</title>
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
            border-bottom: 5px solid #ffc107; /* Aksen Kuning Emas */
        }

        .ppdb-card {
            margin-top: -50px;
            border: none;
            border-radius: 20px;
            background: white;
            border-top: 5px solid #ffc107;
        }

        .btn-cek {
            background-color: #ffc107;
            color: #081a33;
            font-weight: 700;
            border-radius: 10px;
            padding: 12px;
            border: none;
        }

        .btn-cek:hover {
            background-color: #e0ac00;
            color: #000;
        }

        .result-box {
            border-top: 2px dashed #dee2e6;
            margin-top: 25px;
            padding-top: 25px;
        }

        .status-diterima { color: #198754; font-weight: 800; font-size: 1.5rem; }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .step-icon {
            width: 50px;
            height: 50px;
            background: #fff3cd;
            color: #856404;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 15px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
            <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
            <span class="brand-text fw-bold">COREJKT PENDIDIKAN</span>
        </a>
        <div class="ms-auto">
            <a href="pendidikan.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Layanan Sekolah
            </a>
        </div>
    </div>
</nav>

<header class="page-header text-center">
    <div class="container">
        <i class="fas fa-graduation-cap fa-3x mb-3"></i>
        <h1 class="fw-bold">Penerimaan Peserta Didik Baru (PPDB)</h1>
        <p class="lead">Layanan informasi pendaftaran dan cek hasil seleksi sekolah negeri secara transparan.</p>
    </div>
</header>

<div class="container mb-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card ppdb-card shadow-lg p-4 p-md-5 text-start">
                <h4 class="fw-bold text-center mb-4" style="color: var(--blue-dark);">Cek Hasil Seleksi</h4>
                
                <?= $pesan ?>

                <form method="POST" action="">
                    <div class="mb-4">
                        <label class="form-label fw-bold small">Nomor Pendaftaran / Nomor Peserta</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" name="nomor_peserta" class="form-control border-start-0 py-2" placeholder="Contoh: 202500012345" required>
                        </div>
                    </div>
                    
                    <button type="submit" name="cek_status" class="btn btn-cek w-100 shadow-sm">
                        <i class="fas fa-search-location me-2"></i> Lihat Hasil Seleksi
                    </button>
                </form>

                <?php if ($hasil_seleksi): ?>
                <div class="result-box animated fadeIn">
                    <div class="text-center mb-4">
                        <p class="mb-0 text-muted small">HASIL SELEKSI SEMENTARA</p>
                        <h2 class="status-diterima"><?= $hasil_seleksi['status'] ?></h2>
                    </div>

                    <div class="info-row">
                        <span class="text-muted small">Nama Peserta</span>
                        <span class="fw-bold"><?= $hasil_seleksi['nama'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="text-muted small">Sekolah Tujuan</span>
                        <span class="fw-bold"><?= $hasil_seleksi['sekolah_tujuan'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="text-muted small">Jalur Seleksi</span>
                        <span class="fw-bold"><?= $hasil_seleksi['jalur'] ?></span>
                    </div>
                    <div class="info-row">
                        <span class="text-muted small">Nilai/Skor Akhir</span>
                        <span class="fw-bold"><?= $hasil_seleksi['skor'] ?></span>
                    </div>
                    <div class="info-row mb-4">
                        <span class="text-muted small">Peringkat Saat Ini</span>
                        <span class="fw-bold text-primary"><?= $hasil_seleksi['posisi'] ?></span>
                    </div>

                    <div class="d-grid gap-2">
                        <button onclick="window.print()" class="btn btn-dark btn-sm rounded-pill">
                            <i class="fas fa-print me-2"></i> Cetak Bukti Hasil Seleksi
                        </button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="mt-5 pt-4">
        <h4 class="fw-bold mb-5" style="color: var(--blue-dark);">Alur Pendaftaran PPDB</h4>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="step-icon"><i class="fas fa-id-card fa-lg"></i></div>
                <h6 class="fw-bold">1. Pra-Pendaftaran</h6>
                <p class="small text-muted">Verifikasi dokumen dan data kependudukan.</p>
            </div>
            <div class="col-md-3">
                <div class="step-icon"><i class="fas fa-edit fa-lg"></i></div>
                <h6 class="fw-bold">2. Pengajuan Akun</h6>
                <p class="small text-muted">Mendapatkan token untuk akses pendaftaran.</p>
            </div>
            <div class="col-md-3">
                <div class="step-icon"><i class="fas fa-school fa-lg"></i></div>
                <h6 class="fw-bold">3. Pilih Sekolah</h6>
                <p class="small text-muted">Memilih sekolah sesuai jalur zonasi atau prestasi.</p>
            </div>
            <div class="col-md-3">
                <div class="step-icon"><i class="fas fa-clipboard-check fa-lg"></i></div>
                <h6 class="fw-bold">4. Lapor Diri</h6>
                <p class="small text-muted">Konfirmasi penerimaan jika dinyatakan lolos.</p>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-white border-top mt-auto text-center text-muted small">
    <div class="container">
        &copy; 2025 CoreJKT - Dinas Pendidikan Provinsi DKI Jakarta Digital.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>