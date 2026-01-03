<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TITAH RESMI - CoreJKT Mega Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Plus+Jakarta+Sans:wght@300;400;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --mega-blue: #00d2ff;
            --royal-gold: #ffc107;
            --deep-void: #051025;
            --blood-red: #ff4757;
        }

        body {
            background-color: var(--deep-void);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Navbar Gahar */
        .navbar {
            background: rgba(5, 16, 37, 0.8) !important;
            backdrop-filter: blur(15px);
            border-bottom: 2px solid var(--mega-blue);
        }

        /* Header Dramatis */
        .page-header {
            background: linear-gradient(rgba(5, 16, 37, 0.7), rgba(5, 16, 37, 0.7)),
                url('https://images.unsplash.com/photo-1555899434-94d1368aa7af?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            position: relative;
            border-bottom: 5px solid var(--royal-gold);
            animation: headerGlow 5s infinite alternate;
        }

        @keyframes headerGlow {
            from {
                box-shadow: inset 0 0 50px #000;
            }

            to {
                box-shadow: inset 0 0 100px var(--mega-blue);
            }
        }

        .mega-title {
            font-family: 'Cinzel', serif;
            font-size: 3.5rem;
            letter-spacing: 5px;
            text-transform: uppercase;
            text-shadow: 0 0 20px var(--mega-blue);
        }

        /* Card Alay tapi Mahal */
        .announcement-item {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .announcement-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: 0.5s;
        }

        .announcement-item:hover {
            transform: scale(1.02) rotate(0.5deg);
            border-color: var(--mega-blue);
            box-shadow: 0 0 30px rgba(0, 210, 255, 0.3);
        }

        .announcement-item:hover::before {
            left: 100%;
        }

        .announcement-date {
            color: var(--mega-blue);
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        /* Badge Gila */
        .urgency-badge {
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 800;
            letter-spacing: 2px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
                box-shadow: 0 0 20px var(--blood-red);
            }

            100% {
                transform: scale(1);
            }
        }

        .urgency-penting {
            background: var(--blood-red);
            color: white;
        }

        .urgency-biasa {
            background: var(--mega-blue);
            color: var(--deep-void);
        }

        /* Button Super Gahar */
        .btn-mega {
            background: linear-gradient(45deg, var(--mega-blue), #0056b3);
            border: none;
            color: white;
            font-weight: 800;
            padding: 12px 30px;
            border-radius: 50px;
            text-transform: uppercase;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(0, 210, 255, 0.4);
        }

        .btn-mega:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px var(--mega-blue);
            color: white;
        }

        /* Footer Megalomania */
        footer {
            background: linear-gradient(to top, #000, var(--deep-void)) !important;
            border-top: 2px solid var(--royal-gold);
            padding: 60px 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo" class="me-2"
                    style="height: 50px; filter: drop-shadow(0 0 5px var(--mega-blue));">
                <span class="brand-text fw-bold" style="letter-spacing: 2px;">CORE<span class="text-info">JKT</span>
                    SUPREMACY</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-mega"><i class="fas fa-home"></i> Kembali</a>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-bolt fa-4x mb-3 text-warning"></i>
            <h1 class="mega-title fw-bold mb-0">Sabda & Titah Resmi</h1>
            <p class="lead mt-2 fw-light">Demi Kedaulatan Informasi dan Kejayaan Jakarta 2026</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="announcement-item shadow-lg" style="border-left: 10px solid var(--blood-red);">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="announcement-date"><i class="fas fa-calendar-day"></i> Fajar, 10 Desember
                                2025</span>
                            <h2 class="mt-2 mb-3 fw-bold" style="color: var(--royal-gold);">REVOLUSI TARIF: Retribusi
                                Sampah Abad 2026</h2>
                        </div>
                        <span class="badge urgency-badge urgency-penting">LEVEL: KRITIS</span>
                    </div>
                    <p class="fs-5 fw-light">
                        Wahai Warga! Persiapkan dirimu! Berdasarkan <span class="text-info fw-bold">TITAH PERGUB NO.
                            X/2025</span>, struktur dunia persampahan akan berubah total per 1 Januari 2026. Jangan
                        biarkan dirimu tertinggal dalam kegelapan administrasi!
                    </p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-mega"><i class="fas fa-book-open me-2"></i> Bedah Rahasia Pergub</a>
                    </div>
                </div>

                <div class="announcement-item shadow-lg" style="border-left: 10px solid var(--mega-blue);">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="announcement-date"><i class="fas fa-calendar-day"></i> 01 Desember 2025</span>
                            <h2 class="mt-2 mb-3 fw-bold" style="color: #ffffff;">KEBANGKITAN SKILL: Pelatihan Kerja
                                Tanpa Mahar!</h2>
                        </div>
                        <span class="badge urgency-badge urgency-biasa">INFO MEGA</span>
                    </div>
                    <p class="fs-5 fw-light">
                        Taklukkan dunia digital! Dinas Ketenagakerjaan memanggil jiwa-jiwa haus ilmu untuk menguasai
                        <span class="text-warning fw-bold">CODING & DIGITAL MARKETING</span>. Tanpa biaya! Hanya untuk
                        mereka yang berani bermimpi!
                    </p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-mega"><i class="fas fa-fire me-2"></i> Klaim Takdirmu</a>
                    </div>
                </div>

                <div class="announcement-item shadow-lg" style="border-left: 10px solid #ffa502;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="announcement-date"><i class="fas fa-calendar-day"></i> 25 November 2025</span>
                            <h2 class="mt-2 mb-3 fw-bold" style="color: #ffa502;">ALAM BERGEJOLAK: Amukan Langit Jakarta
                            </h2>
                        </div>
                        <span class="badge bg-warning text-dark urgency-badge">WASPADA MINGGIR</span>
                    </div>
                    <p class="fs-5 fw-light">
                        Waspadalah! Awan hitam menyelimuti cakrawala. Angin kencang akan menari di jalanan. Segera
                        aktifkan <span class="text-danger fw-bold">RADAR BANJIR</span> di genggamanmu. Keselamatan
                        adalah kemewahan yang harus dijaga!
                    </p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-mega" style="background: #ffa502; color: #000;"><i
                                class="fas fa-eye me-2"></i> Pantau Amukan Alam</a>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <button class="btn btn-lg btn-outline-info rounded-pill px-5 py-3 fw-bold">
                        <i class="fas fa-archive me-2"></i> BUKA GERBANG ARSIP MASA LALU
                    </button>
                </div>

            </div>
        </div>
    </div>

    <footer class="text-white">
        <div class="container text-center">
            <h3 class="mega-title" style="font-size: 1.5rem; color: var(--royal-gold);">CoreJKT Sovereign</h3>
            <p class="opacity-50">Karya Agung Pemerintah Provinsi DKI Jakarta Untuk Masa Depan</p>
            <div class="social-icons mt-4">
                <i class="fab fa-instagram fa-2x mx-3"></i>
                <i class="fab fa-twitter fa-2x mx-3"></i>
                <i class="fab fa-youtube fa-2x mx-3"></i>
            </div>
            <p class="mt-5 small">&copy; 2025 - Kekaisaran Digital Jakarta</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>