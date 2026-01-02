<?php
session_start();
require_once __DIR__ . "/config.php"; // Pastikan di config.php Anda sudah ada koneksi $pdo


try {
    // Mengambil semua data dari tabel lalin_rekayasa
    $stmt = $pdo->query("SELECT * FROM lalin_rekayasa ORDER BY id DESC");
    $lalin_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal mengambil data: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Info Lalu Lintas - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root {
            --blue-dark: #081a33;
            --blue-soft: #123b7a;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
        }

        .page-header {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-soft) 100%);
            color: white;
            padding: 60px 0;
            border-bottom: 5px solid #ffc107;
        }

        /* Peta Styling */
        #map {
            height: 400px;
            width: 100%;
            border-radius: 20px;
            z-index: 1;
            border: 4px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .lalin-card {
            border: none;
            border-radius: 15px;
            background: white;
            transition: all 0.3s ease;
            border-left: 6px solid #ccc;
        }

        .lalin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Border warna dinamis berdasarkan tipe */
        .border-info {
            border-left-color: #0dcaf0 !important;
        }

        .border-warning {
            border-left-color: #ffc107 !important;
        }

        .border-danger {
            border-left-color: #dc3545 !important;
        }

        .sidebar-widget {
            background: white;
            border-radius: 20px;
            padding: 25px;
            border: none;
        }

        .badge-status {
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .update-tag {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.85rem;
        }
        
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
                <span class="brand-text fw-bold">CORE LALIN</span>
            </a>
            <div class="ms-auto">
                <a href="transportasi.php" class="btn btn-outline-light btn-sm rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <header class="page-header text-center shadow">
        <div class="container">
            <i class="fas fa-traffic-light fa-4x mb-3 text-warning"></i>
            <h1 class="fw-bold display-5">Rekayasa & Penutupan Jalan</h1>
            <div class="d-flex justify-content-center">
                <span class="update-tag"><i class="fas fa-sync-alt fa-spin me-2"></i> Update Otomatis:
                    <?= date('H:i') ?> WIB</span>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3">
                        <h5 class="fw-bold mb-0 text-dark"><i
                                class="fas fa-map-marked-alt me-2 text-primary"></i>Visualisasi Titik Hambatan Lalu
                            Lintas</h5>
                    </div>
                    <div id="map"></div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <h4 class="fw-bold mb-4" style="color: var(--blue-dark);">Detail Kondisi Jalan</h4>

                <?php foreach ($lalin_list as $l): ?>
                    <div class="card lalin-card shadow-sm mb-4 border-<?= $l['tipe'] ?>">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1 text-dark"><?= $l['lokasi'] ?></h5>
                                    <p class="text-muted small mb-0"><i class="fas fa-info-circle me-1"></i>
                                        <?= $l['kejadian'] ?></p>
                                </div>
                                <span
                                    class="badge badge-status bg-<?= $l['tipe'] ?>-subtle text-<?= $l['tipe'] ?> border border-<?= $l['tipe'] ?>">
                                    <i class="fas fa-satellite-dish me-1"></i> <?= $l['status'] ?>
                                </span>
                            </div>

                            <div class="bg-light p-3 rounded-3 mb-3 border-start border-4 border-<?= $l['tipe'] ?>">
                                <p class="small mb-1 fw-bold text-uppercase text-muted">Arahan Pengalihan Arus:</p>
                                <p class="mb-0 text-dark"><?= $l['dampak'] ?></p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small"><i class="far fa-clock me-1"></i> Estimasi:
                                    <strong><?= $l['estimasi'] ?></strong></span>
                                <button class="btn btn-<?= $l['tipe'] ?> btn-sm rounded-pill px-3"
                                    onclick="focusMap(<?= $l['lat'] ?>, <?= $l['lng'] ?>, '<?= $l['lokasi'] ?>')">
                                    <i class="fas fa-location-arrow me-1"></i> Lihat di Peta
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-widget shadow-sm mb-4">
                    <h6 class="fw-bold mb-3"><i class="fas fa-phone-alt me-2 text-danger"></i>Pusat Bantuan Jalan</h6>
                    <div class="list-group list-group-flush">
                        <a href="tel:14080"
                            class="list-group-item list-group-item-action d-flex justify-content-between px-0 py-3">
                            <span>Jasa Marga</span>
                            <span class="badge bg-danger rounded-pill">14080</span>
                        </a>
                        <a href="tel:1500669"
                            class="list-group-item list-group-item-action d-flex justify-content-between px-0 py-3">
                            <span>NTMC Polri</span>
                            <span class="badge bg-primary rounded-pill">1500669</span>
                        </a>
                        <a href="tel:112"
                            class="list-group-item list-group-item-action d-flex justify-content-between px-0 py-3 border-0">
                            <span>Layanan Darurat</span>
                            <span class="badge bg-dark rounded-pill">112</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2025 CoreJKT - Sistem Informasi Transportasi Cerdas DKI
                Jakarta.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // Inisialisasi Peta Jakarta
        var map = L.map('map').setView([-6.2088, 106.8456], 12);

        // Layer Peta (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Data dari PHP ke JS
        var lalinData = <?= json_encode($lalin_list) ?>;

        // Tambahkan Marker Otomatis
        lalinData.forEach(function (item) {
            var markerColor = (item.tipe === 'danger') ? 'red' : (item.tipe === 'warning') ? 'orange' : 'blue';

            var marker = L.marker([item.lat, item.lng]).addTo(map);
            marker.bindPopup("<b style='color:var(--blue-dark)'>" + item.lokasi + "</b><br>" + item.kejadian + "<br><small>" + item.status + "</small>");
        });

        // Fungsi untuk fokus peta saat tombol diklik
        function focusMap(lat, lng, lokasi) {
            map.setView([lat, lng], 15);
            L.popup()
                .setLatLng([lat, lng])
                .setContent("<b>" + lokasi + "</b>")
                .openOn(map);

            // Scroll halus ke peta
            document.getElementById('map').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>