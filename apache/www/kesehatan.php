<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kesehatan - Layanan CoreJKT</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        :root {
            --jkt-blue: #051025;
            --jkt-soft: #0d6efd;
            --health-teal: #1dd1a1;
            --health-red: #ff4757;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
            color: #2d3436;
        }

        /* Navbar Modern */
        .navbar {
            background: linear-gradient(90deg, var(--jkt-blue) 0%, #0a2558 100%) !important;
            border-bottom: 3px solid var(--jkt-soft);
        }

        /* Header dengan Efek Overlay Dinamis */
        .page-header {
            background: linear-gradient(135deg, var(--jkt-soft) 0%, #0056b3 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
            border-radius: 0 0 50% 50% / 0 0 10% 10%;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
        }

        .page-header i {
            animation: heartBeat 2s infinite;
        }

        @keyframes heartBeat {
            0% {
                transform: scale(1);
            }

            14% {
                transform: scale(1.3);
            }

            28% {
                transform: scale(1);
            }

            42% {
                transform: scale(1.3);
            }

            70% {
                transform: scale(1);
            }
        }

        /* Hoverable Feature Boxes */
        .feature-box {
            border: none;
            border-radius: 20px;
            padding: 20px;
            background: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-bottom: 5px solid transparent;
        }

        .feature-box:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
            border-bottom-color: var(--jkt-soft);
        }

        .card-icon {
            font-size: 3.5rem;
            background: linear-gradient(135deg, var(--jkt-blue), var(--jkt-soft));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
            display: inline-block;
        }

        /* Emergency Card Pulsing */
        .emergency-card {
            background: #fff;
            border-bottom: 5px solid var(--health-red) !important;
        }

        .emergency-card .card-icon {
            background: linear-gradient(135deg, #d63031, #ff7675);
            -webkit-background-clip: text;
            animation: pulse-red 1.5s infinite;
        }

        @keyframes pulse-red {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }

            100% {
                opacity: 1;
            }
        }

        .btn-danger {
            background: var(--health-red);
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
        }

        /* List Group Premium */
        .list-group-item {
            border: none;
            margin-bottom: 10px;
            border-radius: 12px !important;
            background: white;
            transition: 0.3s;
            padding: 20px !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
        }

        .list-group-item:hover {
            background: #e9ecef;
            transform: scale(1.02);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
        }

        .btn-outline-secondary {
            border-radius: 50px;
            border: 2px solid #dee2e6;
            font-weight: 600;
            color: var(--jkt-soft);
        }

        .btn-outline-secondary:hover {
            background: var(--jkt-soft);
            border-color: var(--jkt-soft);
            color: white;
        }

        footer {
            border-top: 5px solid var(--jkt-gold);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text fw-bold">KESEHATAN <span class="text-info">DKI JAKARTA</span></span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-info text-white rounded-pill px-4 btn-sm">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-heartbeat fa-4x mb-3 text-white"></i>
            <h1 class="display-4 fw-bold mb-0">Layanan Kesehatan Warga</h1>
            <p class="lead mt-2 opacity-75">Solusi cerdas kesehatan masyarakat dalam satu platform terintegrasi.</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--jkt-blue);">Pilihan Layanan Cepat</h2>
            <div class="mx-auto" style="width: 50px; height: 5px; background: var(--jkt-soft); border-radius: 10px;">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100">
                    <div class="card-body text-center d-flex flex-column">
                        <div class="card-icon"><i class="fas fa-calendar-check"></i></div>
                        <h5 class="card-title fw-bold" style="color: var(--jkt-blue);">Antrean Faskes Digital</h5>
                        <p class="card-text small text-secondary flex-grow-1">Hindari kerumunan dengan sistem antrean
                            online. Pantau jadwal dokter dan ketersediaan kuota Puskesmas/RS secara real-time.</p>
                        <a href="antrean_faskes.php"
                            class="btn btn-primary rounded-pill fw-bold mt-3 px-4 shadow-sm">Buat Janji Berobat</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100">
                    <div class="card-body text-center d-flex flex-column">
                        <div class="card-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <h5 class="card-title fw-bold" style="color: var(--jkt-blue);">Peta Faskes Terdekat</h5>
                        <p class="card-text small text-secondary flex-grow-1">Navigasi instan ke titik fasilitas
                            kesehatan terdekat mulai dari RSUD hingga Apotek siaga 24 jam di sekitar Anda.</p>
                        <a href="peta_faskes.php" class="btn btn-primary rounded-pill fw-bold mt-3 px-4 shadow-sm">Buka
                            Navigasi</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm feature-box emergency-card h-100 border-0">
                    <div class="card-body text-center d-flex flex-column">
                        <div class="card-icon"><i class="fas fa-ambulance"></i></div>
                        <h5 class="card-title fw-bold text-danger">Bantuan Darurat 112 / 119</h5>
                        <p class="card-text small text-secondary flex-grow-1">Layanan ambulans gawat darurat gratis
                            untuk seluruh warga Jakarta. Segera hubungi bila terjadi kondisi mengancam nyawa.</p>
                        <a href="tel:112" class="btn btn-danger mt-3 py-2 fs-5">
                            <i class="fas fa-phone-alt me-2"></i> PANGGIL SEKARANG
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5 border-secondary opacity-25">

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h3 class="fw-bold mb-4 text-center" style="color: var(--jkt-blue);">Informasi Kesehatan Penting</h3>
                <div class="list-group shadow-sm border-0">
                    <div
                        class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-syringe fs-4 text-primary me-3"></i>
                            <span class="fw-semibold">Jadwal Vaksinasi COVID-19 & Influenza Terkini</span>
                        </div>
                        <a href="jadwal_vaksin.php" class="btn btn-outline-secondary px-4">Lihat Jadwal</a>
                    </div>

                    <div
                        class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-id-card fs-4 text-success me-3"></i>
                            <span class="fw-semibold">Layanan BPJS: Cek Kepesertaan & Pendaftaran Online</span>
                        </div>
                        <a href="cek_bpjs.php" class="btn btn-outline-secondary px-4">Status BPJS</a>
                    </div>

                    <div
                        class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-notes-medical fs-4 text-warning me-3"></i>
                            <span class="fw-semibold">Edukasi Kesehatan & Tips Gaya Hidup Warga Urban</span>
                        </div>
                        <a href="artikel_kesehatan.php" class="btn btn-outline-secondary px-4">Eksplorasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-5" style="background-color: var(--jkt-blue) !important;">
        <div class="container text-center">
            <p class="mb-2 fw-bold opacity-75">&copy; 2026 CoreJKT Digital - Layanan Kesehatan Terpadu DKI Jakarta.</p>
            <div class="opacity-50 small">Sistem Navigasi Pintar untuk Jakarta yang Lebih Sehat.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animasi sederhana untuk kartu saat di-scroll
        const cards = document.querySelectorAll('.feature-box, .list-group-item');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        cards.forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>
</body>

</html>