<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Daerah - DKI Jakarta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --jkt-blue: #051025;
            --jkt-accent: #00d2ff;
            --jkt-gold: #ffc107;
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
            background-color: #fcfdfe;
        }

        /* Hero Header with Parallax */
        .page-header {
            background: linear-gradient(rgba(5, 16, 37, 0.8), rgba(5, 16, 37, 0.8)),
                url('https://images.unsplash.com/photo-1555899434-94d1368aa7af?q=80&w=2070&auto=format&fit=crop');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
        }

        .section-title {
            font-weight: 800;
            color: var(--jkt-blue);
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60%;
            height: 5px;
            background: var(--jkt-accent);
            border-radius: 10px;
        }

        /* Timeline Sejarah */
        .history-card {
            border: none;
            border-left: 4px solid var(--jkt-accent);
            background: white;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .history-card:hover {
            transform: translateX(10px);
            background: #f0f9ff;
        }

        /* Visi Misi Glassmorphism */
        .visi-box {
            background: linear-gradient(135deg, var(--jkt-blue) 0%, #0a2558 100%);
            color: white;
            border-radius: 20px;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .misi-item {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid #eee;
            transition: 0.3s;
            display: flex;
            align-items: center;
        }

        .misi-item:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-left: 5px solid var(--jkt-gold);
        }

        /* SKPD Interactive Grid */
        .skpd-node {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--jkt-accent);
            cursor: pointer;
            transition: 0.3s;
        }

        .skpd-node:hover {
            background: var(--jkt-accent);
            color: white;
            transform: translateY(-5px);
        }

        /* Navigation Dot */
        .nav-dots {
            position: fixed;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1000;
        }

        .nav-dot {
            width: 12px;
            height: 12px;
            background: #ccc;
            border-radius: 50%;
            margin: 15px 0;
            display: block;
            transition: 0.3s;
        }

        .nav-dot:hover,
        .nav-dot.active {
            background: var(--jkt-accent);
            transform: scale(1.5);
        }
    </style>
</head>

<body>

    <div class="nav-dots d-none d-lg-block">
        <a href="#header" class="nav-dot active" title="Atas"></a>
        <a href="#sejarah" class="nav-dot" title="Sejarah"></a>
        <a href="#visi-misi" class="nav-dot" title="Visi Misi"></a>
        <a href="#struktur" class="nav-dot" title="Struktur"></a>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3" style="background-color: var(--jkt-blue);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
                <span class="fw-bold tracking-tight">PROFIL <span class="text-info">DAERAH</span></span>
            </a>
            <a href="dashboard.php" class="btn btn-info rounded-pill px-4 text-white">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </div>
    </nav>

    <header id="header" class="page-header text-center">
        <div class="container" data-aos="zoom-in">
            <div class="badge bg-info mb-3 px-3 py-2 rounded-pill">PROVINSI DKI JAKARTA</div>
            <h1 class="display-3 fw-bold mb-3">Jantung Nusantara, <br><span class="text-info">Kota Global</span></h1>
            <p class="lead text-white-50 mx-auto" style="max-width: 700px;">
                Menjelajahi transformasi Jakarta dari pelabuhan Sunda Kelapa hingga menjadi pusat kemajuan teknologi dan
                budaya Asia Tenggara.
            </p>
        </div>
    </header>

    <div class="container my-5">
        <section class="mb-5 pb-5" id="sejarah">
            <h2 class="section-title" data-aos="fade-right">Sejarah & Evolusi</h2>
            <div class="row g-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-up">
                    <div class="card history-card p-4 mb-3">
                        <h5 class="text-info fw-bold">1527 - Jayakarta</h5>
                        <p class="mb-0 text-muted">Fatahillah merebut Sunda Kelapa dan mengubah namanya menjadi
                            Jayakarta yang berarti "Kemenangan yang Gemilang".</p>
                    </div>
                    <div class="card history-card p-4 mb-3">
                        <h5 class="text-info fw-bold">1619 - Batavia</h5>
                        <p class="mb-0 text-muted">Belanda di bawah VOC menghancurkan Jayakarta dan membangun kota
                            bergaya Eropa bernama Batavia.</p>
                    </div>
                    <div class="card history-card p-4">
                        <h5 class="text-info fw-bold">1945 - DKI Jakarta</h5>
                        <p class="mb-0 text-muted">Setelah Proklamasi, nama Jakarta diresmikan sebagai Ibu Kota Negara
                            dengan status Daerah Khusus.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center" data-aos="zoom-in-left">
                    <div class="position-relative">
                        <div class="bg-info position-absolute w-100 h-100 rounded-4"
                            style="top:20px; left:20px; z-index:-1; opacity:0.2"></div>
                        <img src="assets/DKI.jpeg" alt="Monas" class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </section>

        <section class="mb-5 pb-5" id="visi-misi">
            <div class="visi-box shadow-lg" data-aos="flip-up">
                <div class="row align-items-center">
                    <div class="col-lg-5 text-center mb-4 mb-lg-0">
                        <i class="fas fa-lightbulb fa-5x text-warning mb-3"></i>
                        <h2 class="fw-bold">VISI</h2>
                        <p class="fs-4 italic">"Jakarta Kota Maju, Lestari, dan Berbudaya"</p>
                    </div>
                    <div class="col-lg-7 border-start border-light border-opacity-25 ps-lg-5">
                        <h3 class="mb-4 text-info">MISI STRATEGIS</h3>
                        <div class="misi-item text-dark">
                            <i class="fas fa-gavel me-3 text-info fs-4"></i>
                            <span class="fw-medium">Tata kelola pemerintahan transparan & melayani warga.</span>
                        </div>
                        <div class="misi-item text-dark">
                            <i class="fas fa-heart-pulse me-3 text-danger fs-4"></i>
                            <span class="fw-medium">Masyarakat sehat, cerdas, dan berdaya saing global.</span>
                        </div>
                        <div class="misi-item text-dark">
                            <i class="fas fa-leaf me-3 text-success fs-4"></i>
                            <span class="fw-medium">Infrastruktur tangguh dan lingkungan hidup yang asri.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="struktur" class="text-center">
            <h2 class="section-title" data-aos="fade-down">Struktur Layanan (SKPD)</h2>
            <p class="text-muted mb-5">Pilar-pilar pelaksana pembangunan Provinsi DKI Jakarta.</p>



            <div class="row g-4 mt-4">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="skpd-node">
                        <i class="fas fa-user-tie fa-2x mb-2"></i>
                        <h6>Biro Umum</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="skpd-node">
                        <i class="fas fa-stethoscope fa-2x mb-2"></i>
                        <h6>Dinas Kesehatan</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="skpd-node">
                        <i class="fas fa-school fa-2x mb-2"></i>
                        <h6>Dinas Pendidikan</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="skpd-node">
                        <i class="fas fa-road fa-2x mb-2"></i>
                        <h6>Dinas Bina Marga</h6>
                    </div>
                </div>
            </div>

            <div class="mt-5" data-aos="zoom-in">
                <a href="#" class="btn btn-lg btn-outline-info rounded-pill px-5">
                    <i class="fas fa-file-pdf me-2"></i> Unduh Struktur Organisasi Lengkap (PDF)
                </a>
            </div>
        </section>
    </div>

    <footer class="text-white py-5" style="background-color: var(--jkt-blue);">
        <div class="container text-center">
            <img src="assets/Logo1.png" style="height: 50px;" class="mb-3 grayscale invert">
            <p class="opacity-50">&copy; 2026 CoreJKT - Digital Government Transformation.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS (Animate On Scroll)
        AOS.init({
            duration: 1000,
            once: true
        });

        // Script untuk update Nav Dots saat scroll
        window.addEventListener('scroll', () => {
            const sections = ['header', 'sejarah', 'visi-misi', 'struktur'];
            const navDots = document.querySelectorAll('.nav-dot');

            sections.forEach((sectionId, index) => {
                const element = document.getElementById(sectionId);
                const rect = element.getBoundingClientRect();
                if (rect.top <= 150 && rect.bottom >= 150) {
                    navDots.forEach(dot => dot.classList.remove('active'));
                    navDots[index].classList.add('active');
                }
            });
        });
    </script>
</body>

</html>