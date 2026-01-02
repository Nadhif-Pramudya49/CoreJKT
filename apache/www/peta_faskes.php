<?php
session_start();
// require_once __DIR__ . "/config.php"; // Pastikan file ini ada

$faskes_list = [
    [
        "nama" => "RSUD Jakarta Pusat",
        "kategori" => "Rumah Sakit",
        "jarak" => "1.2 km",
        "alamat" => "Jl. Medan Merdeka No.10, Jakarta Pusat",
        "telepon" => "(021) 1234567",
        "status" => "Buka 24 Jam",
        "lat" => -6.1754,
        "lng" => 106.8272
    ],
    [
        "nama" => "Puskesmas Tanah Abang",
        "kategori" => "Puskesmas",
        "jarak" => "2.5 km",
        "alamat" => "Jl. KS Tubun No.5, Jakarta Pusat",
        "telepon" => "(021) 7654321",
        "status" => "Tutup (Buka jam 07.00)",
        "lat" => -6.1880,
        "lng" => 106.8120
    ],
    [
        "nama" => "Klinik Pratama Sehat",
        "kategori" => "Klinik",
        "jarak" => "0.8 km",
        "alamat" => "Jl. Kebon Kacang No.12, Jakarta Pusat",
        "telepon" => "(021) 9988776",
        "status" => "Buka sampai 21.00",
        "lat" => -6.1910,
        "lng" => 106.8190
    ]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Peta Faskes Terdekat - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root { --blue-dark: #051025; --blue-soft: #0d6efd; }
        body { background-color: #f0f2f5; }

        #map {
            height: 450px;
            width: 100%;
            border-radius: 15px;
            border: 3px solid #fff;
            z-index: 1;
        }

        .map-container { position: relative; }

        .search-overlay {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            z-index: 1000; /* Harus lebih tinggi dari Leaflet */
        }

        .faskes-sidebar { height: 600px; overflow-y: auto; padding-right: 10px; }
        .faskes-item {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 5px solid var(--blue-soft);
            transition: 0.3s;
            cursor: pointer;
        }
        .faskes-item:hover { transform: scale(1.02); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .dist-tag { background: #e3f2fd; color: var(--blue-soft); padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: bold; }
        .status-pill { font-size: 0.7rem; padding: 3px 8px; border-radius: 5px; }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="brand-text">Sistem Navigasi Kesehatan Jakarta</span>
            </a>
            <a href="#" class="btn btn-outline-light btn-sm rounded-pill px-3">KEMBALI</a>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="fw-bold" style="color: var(--blue-dark);"><i class="fas fa-map-marked-alt text-primary me-2"></i>Faskes Terdekat</h2>
                <p class="text-muted small">Menampilkan lokasi fasilitas kesehatan di Jakarta secara real-time.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="map-container shadow-sm">
                    <div class="search-overlay">
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-search text-muted"></i></span>
                            <input type="text" id="mapSearch" class="form-control border-0" placeholder="Cari faskes...">
                        </div>
                    </div>
                    <div id="map"></div>
                </div>

                <div class="alert alert-warning mt-3 border-0 rounded-4 d-flex align-items-center shadow-sm">
                    <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                    <div>
                        <h6 class="fw-bold mb-0">Kondisi Darurat?</h6>
                        <small>Hubungi <strong>112</strong> untuk bantuan ambulans segera.</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="faskes-sidebar">
                    <?php foreach ($faskes_list as $index => $f): ?>
                        <div class="faskes-item shadow-sm" onclick="focusMap(<?= $f['lat']; ?>, <?= $f['lng']; ?>, '<?= $f['nama']; ?>')">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="dist-tag"><i class="fas fa-location-arrow me-1"></i> <?= $f['jarak']; ?></span>
                                <span class="badge status-pill <?= strpos($f['status'], 'Buka') !== false ? 'bg-success' : 'bg-danger'; ?>">
                                    <?= $f['status']; ?>
                                </span>
                            </div>
                            <h5 class="fw-bold mb-1" style="color: var(--blue-dark);"><?= $f['nama']; ?></h5>
                            <p class="small text-muted mb-3"><i class="fas fa-map-pin me-2"></i><?= $f['alamat']; ?></p>
                            <div class="d-flex gap-2">
                                <a href="tel:<?= $f['telepon']; ?>" class="btn btn-outline-primary btn-sm flex-fill"><i class="fas fa-phone"></i></a>
                                <a href="https://www.google.com/maps?q=<?= $f['lat']; ?>,<?= $f['lng']; ?>" target="_blank" class="btn btn-primary btn-sm flex-fill">Rute</a>
                                <a href="antrean_faskes.php" class="btn btn-dark btn-sm flex-fill">
                                    <i class="fas fa-calendar-check me-1"></i> Antrean
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            &copy; 2025 CoreJKT - Sistem Navigasi Kesehatan Jakarta.
        </div>
    </footer>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-6.1754, 106.8272], 13);

       
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

       
        const faskesData = <?php echo json_encode($faskes_list); ?>;

       
        faskesData.forEach(function(faskes) {
            const marker = L.marker([faskes.lat, faskes.lng]).addTo(map);
            marker.bindPopup(`
                <b>${faskes.nama}</b><br>
                ${faskes.kategori}<br>
                <small>${faskes.status}</small>
            `);
        });

      
        function focusMap(lat, lng, nama) {
            map.setView([lat, lng], 15);
            
        }
    </script>
</body>
</html>