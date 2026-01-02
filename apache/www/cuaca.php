<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . "/config.php";

//  API OpenWeatherMap
$apiKey = "b6def0c12051858d60b6b697e0d774b8";
$city = "Jakarta";
$apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&lang=id&appid={$apiKey}";


$weatherData = @file_get_contents($apiUrl);
if ($weatherData) {
    $data = json_decode($weatherData, true);
    $temp = round($data['main']['temp']);
    $desc = ucwords($data['weather'][0]['description']);
    $icon = $data['weather'][0]['icon'];
    $humidity = $data['main']['humidity'];
    $wind = $data['wind']['speed'];
} else {
   
    $temp = "--";
    $desc = "Data Cuaca Tidak Tersedia";
    $icon = "01d";
    $humidity = "--";
    $wind = "--";
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pantau Cuaca Jakarta - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: #f4f7f6;
        }

        
        .weather-gradient-card {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-soft) 100%);
            color: white;
            border-radius: 25px;
            padding: 40px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .weather-icon-main {
            width: 150px;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
        }

        .temp-display {
            font-size: 5rem;
            font-weight: 800;
            line-height: 1;
        }

        .weather-detail-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .refresh-status {
            font-size: 0.8rem;
            opacity: 0.8;
        }

       
        .cloud-bg {
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 10rem;
            opacity: 0.1;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">PANTAU CUACA KOTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card weather-gradient-card shadow-lg mb-4">
                    <i class="fas fa-cloud cloud-bg"></i>
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center text-md-start">
                            <h4 class="fw-bold mb-1"><i class="fas fa-location-dot me-2"></i><?= $city ?>, Indonesia
                            </h4>
                            <p class="mb-4 opacity-75"><?= date('l, d F Y') ?></p>

                            <div class="temp-display"><?= $temp ?>°C</div>
                            <h3 class="fw-light mb-0"><?= $desc ?></h3>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="https://openweathermap.org/img/wn/<?= $icon ?>@4x.png" class="weather-icon-main"
                                alt="Icon">
                            <div class="refresh-status">
                                <i class="fas fa-sync-alt fa-spin me-1"></i> Data diperbarui otomatis tiap 10 menit
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-4">
                        <div class="col-md-4">
                            <div class="weather-detail-box text-center">
                                <i class="fas fa-droplet mb-2"></i>
                                <p class="small mb-0 opacity-75">Kelembapan</p>
                                <h5 class="fw-bold mb-0"><?= $humidity ?>%</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="weather-detail-box text-center">
                                <i class="fas fa-wind mb-2"></i>
                                <p class="small mb-0 opacity-75">Kecepatan Angin</p>
                                <h5 class="fw-bold mb-0"><?= $wind ?> m/s</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="weather-detail-box text-center">
                                <i class="fas fa-sun mb-2"></i>
                                <p class="small mb-0 opacity-75">Indeks UV</p>
                                <h5 class="fw-bold mb-0">Rendah</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert bg-white border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-lightbulb fa-2x text-warning me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-1">Rekomendasi Hari Ini</h6>
                            <p class="text-muted small mb-0">
                                <?php if (strpos(strtolower($desc), 'hujan') !== false): ?>
                                    Jakarta sedang diprediksi hujan. Jangan lupa siapkan payung atau jas hujan, dan tetap
                                    waspada di titik rawan genangan.
                                <?php else: ?>
                                    Cuaca cukup baik untuk beraktivitas di luar ruangan. Pastikan tetap menjaga hidrasi
                                    tubuh di tengah teriknya matahari Jakarta.
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2025 CoreJKT -  Sistem Informasi Cuaca Terpadu Jakarta.</p>
        </div>
    </footer>

    <script>
        setTimeout(function () {
            window.location.reload();
        }, 600000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>