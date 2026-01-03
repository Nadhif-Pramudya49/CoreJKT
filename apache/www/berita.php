<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Informasi - CoreJKT</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />

    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #0d6efd;
            --accent: #ffc107;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fa;
            color: var(--blue-dark);
        }

        /* Breaking News Ticker */
        .ticker-wrapper {
            background: var(--blue-dark);
            color: white;
            padding: 10px 0;
            overflow: hidden;
        }
        .ticker-text {
            display: inline-block;
            white-space: nowrap;
            animation: ticker 30s linear infinite;
        }
        @keyframes ticker {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Navbar Premium */
        .navbar {
            background: linear-gradient(90deg, var(--blue-dark) 0%, #0a2558 100%) !important;
        }

        /* Hero Highlight */
        .hero-news {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 450px;
            margin-bottom: 40px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .hero-news img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.5s;
        }
        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 40px;
            background: linear-gradient(transparent, rgba(5, 16, 37, 0.9));
            color: white;
        }

        /* Card Berita */
        .news-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }
        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }
        .img-container {
            overflow: hidden;
            height: 200px;
        }
        .news-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .news-card:hover img {
            transform: scale(1.1);
        }
        
        .category-badge {
            background: var(--blue-soft);
            color: white;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.7rem;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 10px;
            display: inline-block;
        }

        .btn-read-more {
            border-radius: 50px;
            font-weight: 600;
            padding: 8px 20px;
            border: 2px solid var(--blue-soft);
            color: var(--blue-soft);
            transition: 0.3s;
        }
        .btn-read-more:hover {
            background: var(--blue-soft);
            color: white;
        }
    </style>
</head>

<body>

    <div class="ticker-wrapper">
        <div class="container">
            <div class="ticker-text">
                <span class="me-5"><i class="fas fa-bolt text-warning"></i> BREAKING NEWS: Jakarta Raih Penghargaan Kota Pintar 2026!</span>
                <span class="me-5"><i class="fas fa-bolt text-warning"></i> INFO: Rekayasa Lalu Lintas di Bundaran HI Mulai Pukul 18.00 WIB</span>
                <span class="me-5"><i class="fas fa-bolt text-warning"></i> PROMO: Diskon Pajak Kendaraan Bermotor hingga Akhir Bulan!</span>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="fw-bold" style="line-height: 1; font-size: 0.9rem;">PORTAL INFORMASI<br><small class="text-info">DKI JAKARTA</small></span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-outline-info rounded-pill px-4"><i class="fas fa-home me-2"></i> Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="fw-800 mb-4" data-aos="fade-right">Berita Utama</h2>

        <div class="hero-news" data-aos="zoom-in">
            <img src="assets/Transjakarta.jpg" alt="Hero News">
            <div class="hero-overlay">
                <span class="category-badge bg-warning text-dark">Eksklusif</span>
                <h1 class="fw-bold">Jakarta Resmi Luncurkan Sistem Navigasi AI Terbaru 2026</h1>
                <p class="mb-3">Transformasi digital Jakarta semakin pesat dengan integrasi kecerdasan buatan untuk seluruh layanan publik warga.</p>
                <a href="#" class="btn btn-info rounded-pill px-4 fw-bold">Baca Selengkapnya</a>
            </div>
        </div>

        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-800 mb-0">Informasi Terkini</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="btn-group">
                    <button class="btn btn-white shadow-sm border rounded-pill px-3 active">Semua</button>
                    <button class="btn btn-white shadow-sm border rounded-pill px-3 ms-2">Transportasi</button>
                    <button class="btn btn-white shadow-sm border rounded-pill px-3 ms-2">Pajak</button>
                    <button class="btn btn-white shadow-sm border rounded-pill px-3 ms-2">Event</button>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card news-card shadow-sm h-100">
                    <div class="img-container">
                        <img src="assets/Transjakarta.jpg" alt="Berita 1">
                    </div>
                    <div class="card-body">
                        <span class="category-badge">Transportasi</span>
                        <h5 class="fw-bold">Pembukaan Rute Baru Transjakarta Koridor A</h5>
                        <p class="small text-muted"><i class="far fa-calendar-alt me-1"></i> 29 Nov 2025</p>
                        <p class="card-text text-secondary">Meningkatkan aksesibilitas transportasi publik di wilayah pinggiran kota untuk mobilitas warga yang lebih baik.</p>
                        <a href="#" class="btn btn-read-more mt-2">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card news-card shadow-sm h-100">
                    <div class="img-container">
                        <img src="assets/pajak.jpg" alt="Pengumuman">
                    </div>
                    <div class="card-body">
                        <span class="category-badge bg-danger">Pengumuman</span>
                        <h5 class="fw-bold">Batas Akhir Pembayaran Pajak PBB 2025</h5>
                        <p class="small text-muted"><i class="far fa-calendar-alt me-1"></i> 25 Nov 2025</p>
                        <p class="card-text text-secondary">Wajib pajak diingatkan untuk segera melunasi PBB sebelum 31 Desember untuk menghindari denda administratif.</p>
                        <a href="#" class="btn btn-read-more mt-2">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card news-card shadow-sm h-100">
                    <div class="img-container">
                        <img src="assets/wifi.jpg" alt="Kegiatan">
                    </div>
                    <div class="card-body">
                        <span class="category-badge bg-success">Digital</span>
                        <h5 class="fw-bold">100 Titik WiFi Gratis Baru di Jakarta</h5>
                        <p class="small text-muted"><i class="far fa-calendar-alt me-1"></i> 20 Nov 2025</p>
                        <p class="card-text text-secondary">Pemprov DKI menambah akses internet gratis di area publik untuk mendukung UMKM dan pelajar Jakarta.</p>
                        <a href="#" class="btn btn-read-more mt-2">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card news-card shadow-sm h-100">
                    <div class="img-container">
                        <img src="assets/gbk.jpg" alt="Ijo">
                    </div>
                    <div class="card-body">
                        <span class="category-badge bg-primary">Lingkungan</span>
                        <h5 class="fw-bold">Revitalisasi Taman Kota untuk Paru-Paru Jakarta</h5>
                        <p class="small text-muted"><i class="far fa-calendar-alt me-1"></i> 15 Nov 2025</p>
                        <p class="card-text text-secondary">Tiga taman besar di Jakarta Pusat akan diperluas dengan fasilitas jogging track dan area bermain anak.</p>
                        <a href="#" class="btn btn-read-more mt-2">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card news-card shadow-sm h-100">
                    <div class="img-container">
                        <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&w=600&q=80" alt="Monas">
                    </div>
                    <div class="card-body">
                        <span class="category-badge bg-info text-dark">Budaya</span>
                        <h5 class="fw-bold">Festival Budaya Jakarta Night Festival 2026</h5>
                        <p class="small text-muted"><i class="far fa-calendar-alt me-1"></i> 10 Nov 2025</p>
                        <p class="card-text text-secondary">Saksikan parade budaya dan panggung seni spektakuler di sepanjang jalan Sudirman-Thamrin.</p>
                        <a href="#" class="btn btn-read-more mt-2">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card news-card shadow-sm h-100">
                    <div class="img-container">
                        <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=600&q=80" alt="Pasar">
                    </div>
                    <div class="card-body">
                        <span class="category-badge bg-warning text-dark">Ekonomi</span>
                        <h5 class="fw-bold">Bantuan Modal Usaha untuk 1000 UMKM Baru</h5>
                        <p class="small text-muted"><i class="far fa-calendar-alt me-1"></i> 05 Nov 2025</p>
                        <p class="card-text text-secondary">Pemprov DKI Jakarta membuka pendaftaran program Inkubasi Bisnis untuk pengusaha muda.</p>
                        <a href="#" class="btn btn-read-more mt-2">Selengkapnya <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="https://www.beritajakarta.id/" target="_blank" rel="noopener noreferrer"
                class="btn btn-lg btn-primary rounded-pill px-5 shadow">
                <i class="fas fa-plus-circle me-2"></i> Tampilkan Lebih Banyak Berita
            </a>
        </div>
    </div>

    <footer class="py-5" style="background-color: var(--blue-dark);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <img src="assets/Logo1.png" alt="Logo" style="height: 50px;" class="mb-3 grayscale brightness-200">
                    <p class="text-white-50">Menyajikan informasi akurat dan terpercaya untuk warga Jakarta yang cerdas.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="social-links mb-3">
                        <a href="#" class="text-white mx-2 fs-4"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white mx-2 fs-4"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white mx-2 fs-4"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white mx-2 fs-4"><i class="fab fa-youtube"></i></a>
                    </div>
                    <p class="text-white-50 mb-0">&copy; 2026 CoreJKT - Portal Pemerintah Provinsi DKI Jakarta.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS (Animasi on Scroll)
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>