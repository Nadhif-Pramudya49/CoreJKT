<?php
session_start();

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
        :root {
            --blue-dark: #051025;
            --blue-soft: #0d6efd;
            --accent: #00d2ff;
        }

        body {
            font-family: 'Inter', sans-serif;
            /* Background diperbarui menjadi gradasi modern */
            background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(90deg, var(--blue-dark) 0%, #0a2558 100%);
            border-bottom: 3px solid var(--accent);
        }

        .map-container {
            height: 550px;
            width: 100%;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            border: 4px solid white;
            z-index: 1;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .school-list-card {
            height: 550px;
            border: none;
            border-radius: 25px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .list-wrapper {
            overflow-y: auto;
            flex-grow: 1;
            padding: 10px;
        }

        .school-item {
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 15px !important;
            border: 1px solid #f0f0f0 !important;
            margin-bottom: 10px;
            background: white;
        }

        .school-item:hover {
            transform: scale(1.02);
            background-color: #f0f7ff;
            border-color: var(--blue-soft) !important;
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.1);
        }

        .category-filter {
            background: white;
            padding: 10px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Footer diperbarui menjadi Dark Modern */
        footer {
            background-color: var(--blue-dark);
            color: #ffffff;
            border-top: 4px solid var(--accent);
        }

        .footer-logo {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: 0.3s;
        }

        .footer-logo:hover {
            opacity: 1;
        }

        .btn-direction {
            background: var(--blue-soft);
            color: white !important;
            font-weight: bold;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            padding: 5px 15px;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="fas fa-map-marked-alt me-2 text-info"></i>
                <span class="brand-text fw-bold">CORE<span class="text-info">MAP</span> SEKOLAH</span>
            </a>
            <div class="ms-auto">
                <a href="pendidikan.php" class="btn btn-outline-light btn-sm rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-12">
                <h1 class="fw-bold text-dark mb-2">Eksplorasi Navigasi Sekolah</h1>
                <p class="text-muted lead">Cari, temukan, dan dapatkan rute ke sekolah tujuan Anda di Jakarta.</p>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-7">
                <div class="category-filter d-flex align-items-center px-4">
                    <i class="fas fa-search text-muted me-3"></i>
                    <input type="text" id="searchBox" class="form-control border-0 bg-transparent"
                        placeholder="Ketik nama sekolah (contoh: SMAN 8)..." onkeyup="filterSekolah()">
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
                <div class="card school-list-card">
                    <div class="card-header bg-white py-3 border-0 rounded-top-4">
                        <h6 class="fw-bold mb-0 text-primary uppercase small tracking-wider">
                            <i class="fas fa-list-ul me-2"></i>Daftar Sekolah Terverifikasi
                        </h6>
                    </div>
                    <div class="list-wrapper" id="schoolList">
                        <?php foreach ($sekolah_list as $s): ?>
                            <div class="list-group-item school-item p-3 mb-2" data-nama="<?= strtolower($s['nama']) ?>"
                                onclick="fokusSekolah(<?= $s['lat'] ?>, <?= $s['lng'] ?>, '<?= $s['nama'] ?>')">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="fw-bold mb-1"><?= $s['nama'] ?></h6>
                                    <span class="badge bg-info-subtle text-info rounded-pill px-2"
                                        style="font-size: 10px;">AKTIF</span>
                                </div>
                                <p class="small text-muted mb-0">
                                    <i class="fas fa-map-pin text-danger me-1"></i> <?= $s['alamat'] ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-5" style="background-color: var(--blue-dark) !important;">
        <div class="container text-center">
            <div class="mb-3">
                <img src="assets/Logo1.png" alt="Logo" style="height: 50px; filter: brightness(0) invert(1);">
            </div>
            <p class="mb-2 opacity-75 fw-bold">&copy; 2025 CoreJKT Digital - Transformasi Layanan Pendidikan DKI
                Jakarta.</p>
            <div class="opacity-50 small">Menghubungkan Sekolah, Orang Tua, dan Peserta Didik dalam satu ekosistem
                cerdas.</div>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const map = L.map('map').setView([-6.2088, 106.8456], 11);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '© OpenStreetMap contributors © CARTO'
        }).addTo(map);

        const sekolahData = <?php echo json_encode($sekolah_list); ?>;
        const markers = {};

        sekolahData.forEach(function (sekolah) {
            const marker = L.marker([sekolah.lat, sekolah.lng]).addTo(map);
            const popupContent = `
            <div style="width:200px;">
                <h6 style="color:#0d6efd; font-weight:bold; margin-bottom:5px;">${sekolah.nama}</h6>
                <p style="font-size:11px; color:#666; margin-bottom:10px;">${sekolah.alamat}</p>
                <hr style="margin: 5px 0;">
                <a href="https://www.google.com/maps/dir/?api=1&destination=${sekolah.lat},${sekolah.lng}" 
                   target="_blank" class="btn-direction text-center w-100">
                   <i class="fas fa-directions me-1"></i> Navigasi Sekarang
                </a>
            </div>
        `;
            marker.bindPopup(popupContent);
            markers[sekolah.nama] = marker;
        });

        function fokusSekolah(lat, lng, nama) {
            map.flyTo([lat, lng], 16, {
                animate: true,
                duration: 1.5
            });
            setTimeout(() => {
                markers[nama].openPopup();
            }, 1500);
        }

        function filterSekolah() {
            let input = document.getElementById('searchBox').value.toLowerCase();
            let items = document.querySelectorAll('.school-item');
            items.forEach(item => {
                let nama = item.getAttribute('data-nama');
                item.style.display = nama.includes(input) ? "block" : "none";
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>