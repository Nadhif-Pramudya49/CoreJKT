<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Visi & Misi - DKI Jakarta | CoreJKT</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
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
            background-color: #f4f7fa;
            color: #333;
            overflow-x: hidden;
        }

        /* Progress Bar Scroll */
        #progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 5px;
            background: var(--jkt-accent);
            z-index: 9999;
            transition: width 0.1s;
        }

        /* Navbar Custom */
        .navbar {
            background: rgba(5, 16, 37, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        /* Hero Header */
        .hero-section {
            background: linear-gradient(rgba(5, 16, 37, 0.85), rgba(5, 16, 37, 0.85)),
                url('https://images.unsplash.com/photo-1555899434-94d1368aa7af?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 120px 0 180px 0;
            color: white;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
        }

        /* Visi Card Glassmorphism */
        .visi-card {
            background: white;
            border-radius: 30px;
            padding: 60px 40px;
            margin-top: -120px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 100;
            position: relative;
        }

        .visi-card h2 {
            font-weight: 800;
            background: linear-gradient(135deg, var(--jkt-blue), var(--jkt-soft));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Misi Items */
        .misi-container {
            margin-top: 80px;
        }

        .misi-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-left: 6px solid var(--jkt-soft);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .misi-card:hover {
            transform: scale(1.03) translateX(10px);
            background: var(--jkt-blue);
            color: white;
            border-left-color: var(--jkt-gold);
        }

        .misi-icon {
            width: 65px;
            height: 65px;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--jkt-soft);
            margin-right: 25px;
            flex-shrink: 0;
            transition: 0.3s;
        }

        .misi-card:hover .misi-icon {
            background: rgba(255, 255, 255, 0.2);
            color: var(--jkt-gold);
        }

        /* Video Button Ripple Effect */
        .btn-play {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            color: var(--jkt-soft);
            font-size: 2rem;
            cursor: pointer;
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            animation: pulse-white 2s infinite;
        }

        @keyframes pulse-white {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 20px rgba(255, 255, 255, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        footer {
            background: var(--jkt-blue);
            color: white;
            padding: 50px 0;
        }
    </style>
</head>

<body>

    <div id="progress-bar"></div>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
                <span class="fw-bold tracking-tight">VISI <span class="text-info">& MISI</span></span>
            </a>
            <div class="ms-auto">
                <a href="dashboard.php" class="btn btn-outline-info rounded-pill btn-sm px-4">
                    <i class="fas fa-arrow-left me-2"></i>Dashboard
                </a>
            </div>
        </div>
    </nav>

    <section class="hero-section text-center">
        <div class="container" data-aos="zoom-in">
            <div class="btn-play" data-bs-toggle="modal" data-bs-target="#videoModal">
                <i class="fas fa-play"></i>
            </div>
            <h1 class="display-3 fw-bold mb-3">Masa Depan Jakarta</h1>
            <p class="lead opacity-75 mx-auto" style="max-width: 700px;">
                Sinergi kolaborasi dalam mewujudkan Jakarta sebagai pusat inovasi dan budaya global yang berkelanjutan.
            </p>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="visi-card text-center shadow-lg" data-aos="fade-up">
                    <div class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-4 fw-bold">OUR VISION
                    </div>
                    <h2 class="display-5 mb-4 italic">"Jakarta Kota Maju, Lestari, dan Berbudaya"</h2>
                    <p class="text-secondary fs-5 lh-lg">
                        Membangun peradaban modern melalui integrasi teknologi cerdas, pelestarian lingkungan hijau,
                        dan penguatan identitas budaya lokal sebagai fondasi kota global.
                    </p>
                </div>
            </div>
        </div>

        <div class="misi-container row justify-content-center">
            <div class="col-lg-9">
                <h3 class="fw-bold text-center mb-5" data-aos="fade-down">Pilar Misi Strategis</h3>

                <div class="misi-card" data-aos="fade-right">
                    <div class="misi-icon"><i class="fas fa-shield-halved"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Pemerintahan Berintegritas</h5>
                        <p class="text-secondary mb-0">Mewujudkan birokrasi yang transparan, bersih, dan melayani
                            berbasis digital.</p>
                    </div>
                </div>

                <div class="misi-card" data-aos="fade-right" data-aos-delay="100">
                    <div class="misi-icon"><i class="fas fa-graduation-cap"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Sumber Daya Manusia Unggul</h5>
                        <p class="text-secondary mb-0">Meningkatkan kualitas pendidikan dan kesehatan masyarakat berdaya
                            saing global.</p>
                    </div>
                </div>

                <div class="misi-card" data-aos="fade-right" data-aos-delay="200">
                    <div class="misi-icon"><i class="fas fa-leaf"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Ketahanan Ekologi</h5>
                        <p class="text-secondary mb-0">Membangun infrastruktur hijau yang tangguh menghadapi tantangan
                            perubahan iklim.</p>
                    </div>
                </div>

                <div class="misi-card" data-aos="fade-right" data-aos-delay="300">
                    <div class="misi-icon"><i class="fas fa-chart-line"></i></div>
                    <div>
                        <h5 class="fw-bold mb-1">Akselerasi Ekonomi Kreatif</h5>
                        <p class="text-secondary mb-0">Memfasilitasi ekosistem UMKM dan ekonomi digital yang inklusif
                            bagi warga.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-5 text-center">
        <div class="container">
            <p class="mb-0 opacity-50">&copy; 2026 CoreJKT Digital Transformation. Jakarta, Indonesia.</p>
        </div>
    </footer>

    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark border-0 overflow-hidden" style="border-radius: 20px;">
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoIframe" src="https://www.youtube.com/embed/zH8Xf0oN6M8?enablejsapi=1"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // 1. Inisialisasi AOS (Animasi Scroll)
        AOS.init({ duration: 1000, once: true });

        // 2. Progress Bar Scroll
        window.addEventListener('scroll', () => {
            const progress = document.getElementById('progress-bar');
            const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
            const percentage = (window.scrollY / totalHeight) * 100;
            progress.style.width = percentage + '%';
        });

        // 3. Stop Video saat Modal Ditutup
        const videoModal = document.getElementById('videoModal');
        videoModal.addEventListener('hidden.bs.modal', function () {
            const iframe = document.getElementById('videoIframe');
            const src = iframe.src;
            iframe.src = "";
            iframe.src = src;
        });
    </script>
</body>

</html>