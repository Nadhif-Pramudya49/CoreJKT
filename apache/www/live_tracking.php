<?php
session_start();
// require_once __DIR__ . "/config.php";

$vehicles = [
    ["id" => "TJ-102", "tipe" => "Bus TransJakarta", "rute" => "Blok M - Kota", "lat" => -6.1754, "lng" => 106.8272, "status" => "Bergerak"],
    ["id" => "MRT-05", "tipe" => "MRT Jakarta", "rute" => "Lebak Bulus - Bundaran HI", "lat" => -6.1950, "lng" => 106.8230, "status" => "Berhenti"],
    ["id" => "LRT-12", "tipe" => "LRT Jakarta", "rute" => "Pegangsaan Dua - Velodrome", "lat" => -6.1650, "lng" => 106.9000, "status" => "Bergerak"],
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Live Tracking Kendaraan - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #0d6efd;
            --success-green: #28a745;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Styling */
        .navbar {
            background-color: var(--blue-dark) !important;
        }
        .brand-text {
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }
        .btn-back {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 50px;
            padding: 8px 20px;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-back:hover {
            background: white;
            color: var(--blue-dark);
        }

        /* Header Styling */
        .page-header {
            background-color: var(--blue-dark);
            color: white;
            padding: 60px 0;
            margin-bottom: -100px; /* Overlap effect */
            padding-bottom: 140px;
        }

        /* Map Styling */
        #map-tracking {
            height: 600px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 5px solid white;
        }

        /* Vehicle Card Styling */
        .vehicle-card {
            border: none;
            border-radius: 15px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            border-left: 5px solid transparent;
            background: white;
        }
        .vehicle-card:hover {
            transform: translateX(5px);
            border-left: 5px solid var(--blue-soft);
            background-color: #fdfdfd;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        /* Pulse Animation */
        .pulse-online {
            width: 8px;
            height: 8px;
            background-color: var(--success-green);
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            animation: pulse-animation 2s infinite;
        }
        @keyframes pulse-animation {
            0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
        }

        /* Scrollbar Styling */
        .vehicle-list::-webkit-scrollbar {
            width: 5px;
        }
        .vehicle-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .vehicle-list::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        footer {
            background-color: var(--blue-dark) !important;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 35px;">
                <span class="brand-text">COREJKT</span>
            </a>
            <a href="transportasi.php" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Transportasi
            </a>
        </div>
    </nav>

    <header class="page-header text-center">
        <div class="container">
            <i class="fas fa-map-marker-alt fa-3x mb-3 text-info"></i>
            <h1 class="fw-bold">Live Vehicle Tracking</h1>
            <p class="lead opacity-75">Sistem monitoring transportasi publik Jakarta secara real-time</p>
        </div>
    </header>

    <div class="container pb-5">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg p-4 rounded-4" style="z-index: 10; position: relative;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold m-0 text-dark">Armada Aktif</h5>
                        <span class="badge bg-primary rounded-pill"><?= count($vehicles) ?> Kendaraan</span>
                    </div>

                    <div class="mb-4">
                        <label class="small text-muted mb-2">Filter Tipe Kendaraan</label>
                        <select class="form-select border-0 bg-light rounded-pill shadow-sm">
                            <option>Semua Jenis</option>
                            <option>TransJakarta</option>
                            <option>MRT Jakarta</option>
                            <option>LRT Jakarta</option>
                        </select>
                    </div>

                    <div class="vehicle-list" style="max-height: 450px; overflow-y: auto; padding-right: 5px;">
                        <?php foreach ($vehicles as $v): ?>
                            <div class="card vehicle-card shadow-sm p-3"
                                onclick="focusVehicle(<?= $v['lat'] ?>, <?= $v['lng'] ?>, '<?= $v['id'] ?>')">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark"><?= $v['id'] ?></h6>
                                        <small class="text-muted d-block mt-1">
                                            <i class="fas fa-info-circle me-1"></i><?= $v['tipe'] ?>
                                        </small>
                                    </div>
                                    <span class="badge bg-light text-dark border rounded-pill py-2 px-3" style="font-size: 0.65rem;">
                                        <span class="pulse-online"></span> <?= strtoupper($v['status']) ?>
                                    </span>
                                </div>
                                <hr class="my-2 opacity-25">
                                <p class="small mb-0 text-muted">
                                    <i class="fas fa-route me-1 text-primary"></i> <?= $v['rute'] ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div id="map-tracking"></div>
            </div>
        </div>
    </div>

    <footer class="text-white py-5">
        <div class="container text-center">
            <p class="mb-0 opacity-50">&copy; 2025 CoreJKT - Sistem Navigasi Terpadu Jakarta</p>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inisialisasi Peta
        const map = L.map('map-tracking', {
            zoomControl: false
        }).setView([-6.1754, 106.8272], 13);
        
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const vehiclesData = <?php echo json_encode($vehicles); ?>;
        const markers = {};

        // Custom Marker Icon
        const busIcon = L.divIcon({
            className: 'custom-div-icon',
            html: "<div style='background-color:#0d6efd; color:white; width:35px; height:35px; line-height:35px; border-radius:50%; border:3px solid white; box-shadow:0 4px 10px rgba(0,0,0,0.2); text-align:center;'><i class='fas fa-bus'></i></div>",
            iconSize: [35, 35],
            iconAnchor: [17, 17]
        });

        vehiclesData.forEach(v => {
            const marker = L.marker([v.lat, v.lng], { icon: busIcon }).addTo(map);
            marker.bindPopup(`
                <div class="p-2">
                    <h6 class="fw-bold mb-1">${v.id}</h6>
                    <small class="text-muted">${v.tipe}</small><br>
                    <small class="text-primary">${v.rute}</small>
                </div>
            `);
            markers[v.id] = marker;
        });

        function focusVehicle(lat, lng, id) {
            map.flyTo([lat, lng], 16, { duration: 1.5 });
            markers[id].openPopup();
        }

        setInterval(() => {
            vehiclesData.forEach(v => {
                if (v.status === "Bergerak") {
                    const newLat = v.lat + (Math.random() - 0.5) * 0.0015;
                    const newLng = v.lng + (Math.random() - 0.5) * 0.0015;
                    markers[v.id].setLatLng([newLat, newLng]);
                }
            });
        }, 3000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>