<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transportasi Publik - Layanan CoreJKT</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --jkt-blue: #051025;
            --jkt-soft: #0d6efd;
            --jkt-accent: #00d2ff;
            --jkt-gold: #ffc107;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
            color: #2d3436;
            overflow-x: hidden;
        }

        /* Navbar Enhancement */
        .navbar {
            background: linear-gradient(90deg, var(--jkt-blue) 0%, #0a2558 100%) !important;
            border-bottom: 3px solid var(--jkt-accent);
        }

        /* Page Header with Motion */
        .page-header {
            background: linear-gradient(135deg, var(--jkt-blue) 0%, #0d6efd 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }

        .page-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            opacity: 0.1;
        }

        .page-header i.fa-bus {
            animation: moveBus 4s infinite linear;
            display: inline-block;
        }

        @keyframes moveBus {
            0% {
                transform: translateX(-10px) rotate(0deg);
            }

            50% {
                transform: translateX(10px) rotate(2deg);
            }

            100% {
                transform: translateX(-10px) rotate(0deg);
            }
        }

        /* Feature Cards (Glassmorphism) */
        .feature-box {
            border: none;
            border-radius: 24px;
            background: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .feature-box:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(13, 110, 253, 0.15) !important;
        }

        .card-icon-wrapper {
            width: 70px;
            height: 70px;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            color: var(--jkt-soft);
            font-size: 2.2rem;
            transition: 0.3s;
        }

        .feature-box:hover .card-icon-wrapper {
            background: var(--jkt-soft);
            color: white;
            transform: scale(1.1);
        }

        /* Disabled Card (Coming Soon) */
        .disabled-card {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            filter: none !important;
            /* Biar tetap kebaca tapi soft */
            opacity: 0.8;
            cursor: default !important;
        }

        .disabled-card .card-icon-wrapper {
            background: #eee;
            color: #adb5bd;
        }

        /* List Group Premium */
        .info-list-container {
            background: white;
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        }

        .list-group-item {
            border: none;
            margin-bottom: 10px;
            border-radius: 15px !important;
            background: #fcfdfe;
            transition: 0.3s;
            padding: 20px !important;
            border: 1px solid #f1f3f9;
        }

        .list-group-item:hover {
            background: #fff;
            transform: translateX(10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
            border-color: var(--jkt-soft);
        }

        .btn-modern {
            border-radius: 50px;
            font-weight: 700;
            padding: 10px 25px;
            transition: 0.3s;
        }

        footer {
            background-color: var(--jkt-blue);
            border-top: 5px solid var(--jkt-accent);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
                <span class="brand-text fw-bold">TRANS<span class="text-info">PORTASI</span> JKT</span>
            </a>
            <div class="ms-auto">
                <a href="dashboard.php" class="btn btn-info text-white rounded-pill px-4 btn-sm fw-bold shadow-sm">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
            </div>
        </div>
    </nav>

    <section class="page-header text-center">
        <div class="container" data-aos="zoom-in">
            <i class="fas fa-bus fa-4x mb-4 text-white"></i>
            <h1 class="display-4 fw-bold mb-0">Transportasi Publik Terintegrasi</h1>
            <p class="lead mt-3 opacity-75 mx-auto" style="max-width: 700px;">Pantau rute tercepat, lacak posisi
                angkutan secara real-time, dan jelajahi Jakarta dengan cerdas.</p>
        </div>
    </section>

    <div class="container my-5 pt-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold" style="color: var(--jkt-blue);">Solusi Perjalanan Anda</h2>
            <div class="mx-auto" style="width: 60px; height: 5px; background: var(--jkt-soft); border-radius: 10px;">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card feature-box h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon-wrapper">
                            <i class="fas fa-location-arrow"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--jkt-blue);">Live Tracking</h4>
                        <p class="text-secondary small mb-4">Lacak posisi real-time Transjakarta, MRT, dan LRT. Ketahui
                            waktu kedatangan di halte terdekat dengan presisi tinggi.</p>
                        <a href="live_tracking.php" class="btn btn-primary w-100 btn-modern shadow">Mulai Lacak</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card feature-box h-100 disabled-card">
                    <div class="card-body text-center">
                        <div class="card-icon-wrapper">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-2 text-muted">E-Ticketing</h4>
                        <span class="badge bg-warning text-dark mb-3 px-3 rounded-pill">DEVELOPMENT</span>
                        <p class="text-muted small mb-4">Beli tiket MRT, LRT, dan KRL langsung dari ponsel Anda.
                            Pembayaran digital aman tanpa antrean fisik.</p>
                        <button data-bs-toggle="modal" data-bs-target="#maintenanceModal"
                            class="btn btn-secondary w-100 btn-modern shadow-sm">Beli Tiket</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12" data-aos="fade-up" data-aos-delay="300">
                <div class="card feature-box h-100 shadow-sm">
                    <div class="card-body text-center">
                        <div class="card-icon-wrapper">
                            <i class="fas fa-route"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: var(--jkt-blue);">Jadwal & Rute</h4>
                        <p class="text-secondary small mb-4">Informasi lengkap rute integrasi antarmoda, tarif terbaru,
                            dan jadwal operasional 24 jam di seluruh wilayah DKI.</p>
                        <a href="transportasi_rute.php" class="btn btn-primary w-100 btn-modern shadow">Cek Jadwal</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-9" data-aos="fade-up">
                <div class="info-list-container">
                    <h3 class="fw-bold mb-4 text-center" style="color: var(--jkt-blue);">Monitor Infrastruktur Kota</h3>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-info-subtle rounded-3 me-3 text-info"><i
                                        class="fas fa-video fs-5"></i></div>
                                <span class="fw-bold">Pantauan CCTV Lalu Lintas Kota</span>
                            </div>
                            <a href="cctv.php" class="btn btn-outline-primary btn-modern btn-sm px-4">Lihat CCTV</a>
                        </div>

                        <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-danger-subtle rounded-3 me-3 text-danger"><i
                                        class="fas fa-ambulance fs-5"></i></div>
                                <span class="fw-bold">Pelaporan Kendaraan Darurat (Live Tracking)</span>
                            </div>
                            <a href="lapor.php" class="btn btn-outline-danger btn-modern btn-sm px-4">Lapor Darurat</a>
                        </div>

                        <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-warning-subtle rounded-3 me-3 text-warning"><i
                                        class="fas fa-exclamation-triangle fs-5"></i></div>
                                <span class="fw-bold">Informasi Penutupan & Rekayasa Lalin</span>
                            </div>
                            <a href="lalin_rekayasa.php" class="btn btn-outline-secondary btn-modern btn-sm px-4">Cek
                                Info Lalin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="maintenanceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-warning py-4 border-0">
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-tools me-2"></i>Under Construction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-5">
                    <i class="fas fa-rocket fa-4x text-warning mb-4 animate-bounce"></i>
                    <h4 class="fw-bold mb-3">Sabar Ya, Sedang Ngebut! 🚀</h4>
                    <p class="text-secondary mb-0">Fitur <b>Beli Tiket Digital</b> sedang kami optimalkan agar transaksi
                        Anda secepat kilat dan aman.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button class="btn btn-dark rounded-pill px-5 fw-bold" data-bs-dismiss="modal">Siap, Nanti Balik
                        Lagi</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-5 text-white text-center mt-5">
        <div class="container">
            <img src="assets/Logo1.png" style="height: 50px;" class="mb-4 opacity-75">
            <p class="mb-0 opacity-50">&copy; 2026 CoreJKT - Smart Transport System DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });
    </script>
</body>

</html>