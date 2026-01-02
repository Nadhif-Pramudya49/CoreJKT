<?php
session_start();
require_once __DIR__ . "/config.php";


try {
    // Query untuk mengambil data rute transportasi
    $stmt = $pdo->query("SELECT * FROM transportasi_rute");
    $transport_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal mengambil data transportasi: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal & Rute Transportasi - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body { background-color: #f8f9fa; }
        
        .transport-header {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1555886643-d51b3c0d9b2e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
        }

        .mode-card {
            border: none;
            border-radius: 20px;
            transition: 0.3s;
            overflow: hidden;
        }

        .mode-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .icon-header {
            padding: 30px;
            font-size: 3rem;
            color: white;
            text-align: center;
        }

        .status-pill {
            font-size: 0.7rem;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            font-weight: bold;
        }

        .info-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .info-value {
            font-weight: 700;
            color: var(--blue-dark);
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
            <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
            <span class="brand-text fw-bold">INFO TRANSPORTASI</span>
        </a>
        <div class="ms-auto">
            <a href="transportasi.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</nav>

<header class="transport-header text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Jadwal & Rute Terkini</h1>
        <p class="lead">Panduan mobilitas pintar untuk warga Jakarta yang lebih produktif.</p>
    </div>
</header>

<div class="container my-5">
    <div class="row justify-content-center mb-5" style="margin-top: -120px;">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 p-4 rounded-4">
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label small fw-bold">Dari Mana?</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-map-marker-alt text-danger"></i></span>
                            <input type="text" class="form-control bg-light border-0" placeholder="Lokasi asal...">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small fw-bold">Ke Mana?</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-location-arrow text-primary"></i></span>
                            <input type="text" class="form-control bg-light border-0" placeholder="Lokasi tujuan...">
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100 rounded-3 py-2" style="background-color: var(--blue-soft);">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php foreach ($transport_data as $t): ?>
        <div class="col-lg-3 col-md-6">
            <div class="card mode-card h-100 shadow-sm">
                <div class="icon-header <?= $t['warna'] ?>">
                    <i class="fas <?= $t['icon'] ?>"></i>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0"><?= $t['mode'] ?></h5>
                        <span class="status-pill text-uppercase"><?= $t['status'] ?></span>
                    </div>
                    
                    <div class="mb-3">
                        <p class="info-label">Tarif Estimasi</p>
                        <p class="info-value"><?= $t['tarif'] ?></p>
                    </div>
                    <div class="mb-3">
                        <p class="info-label">Jam Operasional</p>
                        <p class="info-value"><?= $t['jam'] ?></p>
                    </div>
                    <div class="mb-4">
                        <p class="info-label">Rute Terpopuler</p>
                        <p class="info-value small"><?= $t['rute_populer'] ?></p>
                    </div>
                    
                    <a href="#" class="btn btn-outline-dark w-100 rounded-pill fw-bold" style="font-size: 0.8rem;">Cek Jadwal Lengkap</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm" style="background-color: #e9ecef;">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center text-md-start">
                            <img src="assets/jaklinko.png" alt="JakLingko" class="img-fluid mb-3 mb-md-0" style="max-height: 60px;">
                        </div>
                        <div class="col-md-8">
                            <h5 class="fw-bold">Gunakan JakLingko untuk Tarif Terintegrasi!</h5>
                            <p class="text-muted small mb-0">Nikmati tarif maksimal Rp 10.000 untuk perjalanan menggunakan TransJakarta, MRT, dan LRT dalam durasi 3 jam. Lebih hemat dan lebih mudah.</p>
                        </div>
                        <div class="col-md-2 text-md-end text-center mt-3 mt-md-0">
                            <a href="https://www.jaklingkoindonesia.co.id/en" class="btn btn-dark rounded-pill px-4 btn-sm">Pelajari</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-white border-top mt-5 text-center text-muted small">
    <div class="container">
        &copy; 2025 CoreJKT - Layanan Informasi Transportasi Terpadu Jakarta.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>