<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
// require_once __DIR__ . "/config.php";

$apiKey = "b6def0c12051858d60b6b697e0d774b8";
$city = "Jakarta";

// 1. Data Cuaca Saat Ini
$currentUrl = "https://api.openweathermap.org/data/2.5/weather?q={$city}&units=metric&lang=id&appid={$apiKey}";
$weatherData = @file_get_contents($currentUrl);
if ($weatherData) {
    $data = json_decode($weatherData, true);
    $temp = round($data['main']['temp']);
    $desc = ucwords($data['weather'][0]['description']);
    $icon = $data['weather'][0]['icon'];
    $humidity = $data['main']['humidity'];
    $wind = $data['wind']['speed'];
    $pressure = $data['main']['pressure'];
} else {
    $temp = "--";
    $desc = "Data Tidak Tersedia";
    $icon = "01d";
    $humidity = "--";
    $wind = "--";
    $pressure = "--";
}

// 2. Data Prakiraan (Forecast) 5 Hari
$forecastUrl = "https://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&lang=id&appid={$apiKey}";
$forecastDataRaw = @file_get_contents($forecastUrl);
$forecasts = [];
if ($forecastDataRaw) {
    $fData = json_decode($forecastDataRaw, true);
    // Kita ambil data jam 12 siang setiap harinya
    foreach ($fData['list'] as $item) {
        if (strpos($item['dt_txt'], '12:00:00') !== false) {
            $forecasts[] = [
                'day' => date('D', $item['dt']),
                'temp' => round($item['main']['temp']),
                'icon' => $item['weather'][0]['icon'],
                'desc' => $item['weather'][0]['description']
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Cuaca Jakarta - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #0d6efd;
            --glass: rgba(255, 255, 255, 0.15);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(180deg, #f0f4f8 0%, #d9e2ec 100%);
            min-height: 100vh;
        }

        .weather-main-card {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-soft) 100%);
            border-radius: 30px;
            color: white;
            padding: 40px;
            border: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(5, 16, 37, 0.2);
        }

        .weather-icon-animate {
            width: 160px;
            animation: float 4s ease-in-out infinite;
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.4));
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .glass-box {
            background: var(--glass);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 15px;
            transition: 0.3s;
        }

        .glass-box:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
        }

        .forecast-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .forecast-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(13, 110, 253, 0.15);
        }

        .section-title {
            font-weight: 700;
            color: var(--blue-dark);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .temp-main {
            font-size: 5.5rem;
            font-weight: 800;
            letter-spacing: -2px;
        }

        .cloud-bg-element {
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 12rem;
            opacity: 0.05;
            z-index: 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
                <span class="fw-bold">CORE<span class="text-info">WEATHER</span></span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-outline-light rounded-pill px-4 btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-10">
                <div class="weather-main-card shadow-lg">
                    <i class="fas fa-cloud cloud-bg-element"></i>
                    <div class="row align-items-center relative-z">
                        <div class="col-md-7 text-center text-md-start">
                            <h5 class="fw-bold text-info text-uppercase mb-2" style="letter-spacing: 2px;">Cuaca Saat
                                Ini</h5>
                            <h2 class="fw-bold mb-0"><i class="fas fa-location-dot me-2"></i><?= $city ?>, JKT</h2>
                            <p class="opacity-75"><?= date('l, d F Y | H:i') ?> WIB</p>

                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                <span class="temp-main"><?= $temp ?>°</span>
                                <div class="ms-3 text-start">
                                    <h4 class="mb-0 fw-bold">Celcius</h4>
                                    <p class="mb-0 opacity-75"><?= $desc ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 text-center">
                            <img src="https://openweathermap.org/img/wn/<?= $icon ?>@4x.png"
                                class="weather-icon-animate" alt="icon">
                        </div>
                    </div>

                    <div class="row g-3 mt-4">
                        <div class="col-md-3 col-6">
                            <div class="glass-box text-center">
                                <i class="fas fa-droplet text-info mb-2"></i>
                                <p class="small mb-0 opacity-75">Kelembapan</p>
                                <h5 class="fw-bold mb-0"><?= $humidity ?>%</h5>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="glass-box text-center">
                                <i class="fas fa-wind text-warning mb-2"></i>
                                <p class="small mb-0 opacity-75">Kec. Angin</p>
                                <h5 class="fw-bold mb-0"><?= $wind ?> m/s</h5>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="glass-box text-center">
                                <i class="fas fa-gauge-high text-success mb-2"></i>
                                <p class="small mb-0 opacity-75">Tekanan</p>
                                <h5 class="fw-bold mb-0"><?= $pressure ?> hPa</h5>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="glass-box text-center">
                                <i class="fas fa-sun text-danger mb-2"></i>
                                <p class="small mb-0 opacity-75">UV Index</p>
                                <h5 class="fw-bold mb-0">Rendah</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h4 class="section-title"><i class="fas fa-calendar-days text-primary"></i> Prakiraan 5 Hari Kedepan
                </h4>
                <div class="row g-3">
                    <?php foreach ($forecasts as $f): ?>
                        <div class="col">
                            <div class="forecast-card shadow-sm">
                                <p class="fw-bold text-muted mb-1"><?= $f['day'] ?></p>
                                <img src="https://openweathermap.org/img/wn/<?= $f['icon'] ?>.png" alt="icon">
                                <h4 class="fw-bold mb-0"><?= $f['temp'] ?>°</h4>
                                <p class="small text-muted text-capitalize mb-0"><?= $f['desc'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-25 p-3 rounded-circle me-4">
                                <i class="fas fa-lightbulb text-warning fa-2x"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">Rekomendasi Aktivitas</h5>
                                <p class="text-muted mb-0">
                                    <?php if (strpos(strtolower($desc), 'hujan') !== false): ?>
                                        Siapkan payung atau jas hujan sebelum beraktivitas di luar. Pantau titik genangan
                                        air di portal CoreJKT.
                                    <?php else: ?>
                                        Cuaca cerah berawan. Sangat cocok untuk berolahraga di taman kota Jakarta pagi ini.
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-5 mt-5" style="background-color: var(--blue-dark);">
        <div class="container text-center">
            <div class="mb-3">
                <i class="fas fa-cloud-sun fa-2x text-info"></i>
            </div>
            <p class="mb-1 fw-bold">© 2026 CoreJKT Smart City</p>
            <p class="small opacity-50">Sistem Informasi Cuaca Terintegrasi Jakarta. Data oleh OpenWeather.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto refresh halaman setiap 10 menit
        setTimeout(() => { window.location.reload(); }, 600000);
    </script>
</body>

</html>