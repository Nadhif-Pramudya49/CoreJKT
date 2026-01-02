<?php
session_start();
// require_once __DIR__ . "/config.php"; // Pastikan file ini ada atau sesuaikan path-nya

// Data Sekolah Unggulan untuk Daftar Cepat
$sekolah_list = [
    ["nama" => "SMA Negeri 8 Jakarta", "alamat" => "Tebet, Jakarta Selatan", "lat" => -6.2181, "lng" => 106.8595],
    ["nama" => "SMA Negeri 70 Jakarta", "alamat" => "Kebayoran Baru, Jakarta Selatan", "lat" => -6.2417, "lng" => 106.7968],
    ["nama" => "SMK Negeri 1 Jakarta", "alamat" => "Sawah Besar, Jakarta Pusat", "lat" => -6.1674, "lng" => 106.8370],
    ["nama" => "SMK Negeri 57 Jakarta", "alamat" => "Pasar Minggu, Jakarta Selatan", "lat" => -6.2916, "lng" => 106.8236]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peta Lokasi Sekolah - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root { --blue-dark: #051025; --blue-soft: #0d6efd; }
        .map-container {
            height: 500px;
            width: 100%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            z-index: 1;
        }
        #map { height: 100%; width: 100%; }
        .school-list-card {
            max-height: 500px;
            overflow-y: auto;
            border: none;
            border-radius: 20px;
        }
        .school-item {
            cursor: pointer;
            transition: 0.2s;
            border-left: 5px solid transparent;
        }
        .school-item:hover {
            background-color: #f8f9fa;
            border-left: 5px solid var(--blue-soft);
        }
        .category-filter {
            background: white;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <span class="brand-text fw-bold">PETA SEKOLAH</span>
        </a>
        <div class="ms-auto">
            <a href="#" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row mb-4 text-center">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--blue-dark);">Eksplorasi Lokasi Sekolah</h2>
            <p class="text-muted">Temukan SMA/SMK Negeri terdekat di wilayah Jakarta menggunakan peta interaktif.</p>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="category-filter shadow-sm d-flex gap-2">
                <input type="text" id="searchBox" class="form-control border-0 bg-light" placeholder="Cari nama sekolah...">
                <button class="btn btn-primary px-4 rounded-pill" style="background-color: var(--blue-soft);">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="map-container">
                <div id="map"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card school-list-card shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="fw-bold mb-0">Sekolah Populer</h6>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach ($sekolah_list as $index => $s): ?>
                    <div class="list-group-item school-item p-3" onclick="fokusSekolah(<?= $s['lat'] ?>, <?= $s['lng'] ?>, '<?= $s['nama'] ?>')">
                        <h6 class="fw-bold mb-1 text-dark"><?= $s['nama'] ?></h6>
                        <p class="small text-muted mb-0"><i class="fas fa-map-marker-alt text-danger me-1"></i> <?= $s['alamat'] ?></p>
                        <div class="mt-2 text-end">
                            <span class="text-primary small fw-bold">Lihat di Peta <i class="fas fa-chevron-right ms-1"></i></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-white border-top mt-5 text-center text-muted small">
    <div class="container">
        © 2025 CoreJKT - Data Lokasi Sekolah Terpadu Jakarta.
    </div>
</footer>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([-6.2088, 106.8456], 11);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const sekolahData = <?php echo json_encode($sekolah_list); ?>;
    const markers = {};

    
    sekolahData.forEach(function(sekolah) {
        const marker = L.marker([sekolah.lat, sekolah.lng]).addTo(map);
        marker.bindPopup(`
            <div style="text-align:center;">
                <b style="color:#0d6efd;">${sekolah.nama}</b><br>
                <small>${sekolah.alamat}</small><br>
                <a href="https://www.google.com/maps/dir/?api=1&destination=${sekolah.lat},${sekolah.lng}" target="_blank" class="btn btn-sm btn-primary text-white mt-2" style="font-size:10px; padding:2px 8px; border-radius:10px;">Petunjuk Arah</a>
            </div>
        `);
        
        markers[sekolah.nama] = marker;
    });

    /
    function fokusSekolah(lat, lng, nama) {
        map.setView([lat, lng], 15);
        markers[nama].openPopup();   /
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>