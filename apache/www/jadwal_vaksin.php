<?php
session_start();
require_once __DIR__ . "/config.php";

// Data Simulasi Jadwal Vaksinasi
$jadwal_vaksin = [
    [
        "lokasi" => "RSUD Jakarta Pusat",
        "jenis" => "COVID-19 (Booster Kedua)",
        "stok" => "Tersedia",
        "kuota" => 50,
        "tanggal" => "Setiap Senin - Jumat",
        "jam" => "08:00 - 12:00",
        "vaksin_digunakan" => "Pfizer / IndoVac"
    ],
    [
        "lokasi" => "Puskesmas Tanah Abang",
        "jenis" => "Influenza Musiman",
        "stok" => "Terbatas",
        "kuota" => 20,
        "tanggal" => "Setiap Rabu & Kamis",
        "jam" => "09:00 - 11:00",
        "vaksin_digunakan" => "VaxigripTetra"
    ],
    [
        "lokasi" => "Klinik Pratama Sehat",
        "jenis" => "COVID-19 & Influenza",
        "stok" => "Tersedia",
        "kuota" => 30,
        "tanggal" => "Sabtu",
        "jam" => "08:00 - 14:00",
        "vaksin_digunakan" => "Bio Farma / Flubio"
    ]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jadwal Vaksinasi - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: #f4f7f6;
        }

        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 50px 0;
            border-bottom: 5px solid var(--blue-dark);
        }

        .search-card {
            margin-top: -40px;
            border: none;
            border-radius: 15px;
            z-index: 10;
        }

        .vaccine-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
            background: white;
        }

        .vaccine-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 5px 12px;
            border-radius: 20px;
        }

        .info-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .info-value {
            font-weight: 600;
            color: var(--blue-dark);
        }

        .btn-register {
            background-color: var(--blue-soft);
            color: white;
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-register:hover {
            background-color: var(--blue-dark);
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">LAYANAN INFORMASI KESEHATAN JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="kesehatan.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <header class="page-header text-center">
        <div class="container">
            <i class="fas fa-syringe fa-3x mb-3"></i>
            <h1 class="fw-bold">Jadwal Vaksinasi DKI Jakarta</h1>
            <p class="lead">Cek ketersediaan stok vaksin COVID-19 & Influenza di faskes terdekat.</p>
        </div>
    </header>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card search-card shadow p-3">
                    <form class="row g-2">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i
                                        class="fas fa-search text-muted"></i></span>
                                <input type="text" class="form-control border-start-0"
                                    placeholder="Cari Puskesmas atau Rumah Sakit...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100"
                                style="background-color: var(--blue-soft);">Cari Lokasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h4 class="fw-bold mb-4" style="color: var(--blue-dark);">Lokasi Vaksinasi Tersedia</h4>
            <div class="row g-4">
                <?php foreach ($jadwal_vaksin as $j): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card vaccine-card h-100 shadow-sm p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="badge bg-light text-primary border rounded-pill">
                                    <i class="fas fa-virus-slash me-1"></i> <?= $j['jenis']; ?>
                                </span>
                                <span
                                    class="status-badge <?= $j['stok'] == 'Tersedia' ? 'bg-success text-white' : 'bg-warning text-dark'; ?>">
                                    <?= $j['stok']; ?>
                                </span>
                            </div>

                            <h5 class="fw-bold mb-1" style="color: var(--blue-dark);"><?= $j['lokasi']; ?></h5>
                            <p class="small text-muted mb-4"><i class="fas fa-map-marker-alt me-1"></i> Wilayah Jakarta
                                Pusat</p>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <p class="info-label">Waktu</p>
                                    <p class="info-value small"><?= $j['tanggal']; ?></p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="info-label">Jam Operasional</p>
                                    <p class="info-value small"><?= $j['jam']; ?></p>
                                </div>
                            </div>

                            <div class="bg-light p-2 rounded mb-4 text-center">
                                <p class="info-label">Vaksin Digunakan</p>
                                <p class="info-value mb-0 small"><?= $j['vaksin_digunakan']; ?></p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Kuota: <strong><?= $j['kuota']; ?>/hari</strong></small>
                                <a href="antrean_faskes.php" class="btn btn-register btn-sm px-4">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="alert alert-info mt-5 border-0 rounded-4 shadow-sm d-flex align-items-center">
            <i class="fas fa-info-circle fa-2x me-3"></i>
            <div>
                <h6 class="fw-bold mb-1">Persyaratan Vaksinasi</h6>
                <small>Membawa KTP/Kartu Keluarga asli, dalam kondisi sehat, dan telah sarapan sebelum
                    vaksinasi.</small>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            &copy; 2025 CoreJKT - Layanan Informasi Kesehatan Jakarta.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>