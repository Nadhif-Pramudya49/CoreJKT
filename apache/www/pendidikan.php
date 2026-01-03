<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendidikan - Layanan CoreJKT</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #0d6efd;
            --accent-yellow: #ffc107;
            --white-glass: rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
            color: #333;
        }

        /* Navbar Enhancement */
        .navbar {
            background: linear-gradient(90deg, var(--blue-dark) 0%, #0a2558 100%) !important;
            border-bottom: 3px solid var(--accent-yellow);
        }

        /* Page Header with Floating Icons */
        .page-header {
            background: linear-gradient(135deg, var(--blue-soft) 0%, #0044cc 100%);
            color: white;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
            border-radius: 0 0 50px 50px;
        }

        .page-header i.fa-graduation-cap {
            animation: float 3s infinite ease-in-out;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.2));
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(5deg);
            }
        }

        /* Feature Box Transformation */
        .feature-box {
            border: none;
            border-radius: 24px;
            background: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-left: 8px solid var(--accent-yellow);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 15px;
        }

        .feature-box:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(13, 110, 253, 0.15) !important;
            border-left-color: var(--blue-soft);
        }

        .card-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            display: inline-block;
            transition: transform 0.5s ease;
        }

        .feature-box:hover .card-icon {
            transform: scale(1.2) rotate(-5deg);
        }

        .info-card .card-icon {
            color: var(--accent-yellow);
            filter: drop-shadow(0 4px 6px rgba(255, 193, 7, 0.3));
        }

        /* Button Customization */
        .btn-check-now {
            background: var(--accent-yellow);
            color: var(--blue-dark);
            font-weight: 800;
            border-radius: 50px;
            padding: 10px 25px;
            border: none;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        }

        .btn-check-now:hover {
            background: var(--blue-dark);
            color: white;
            transform: scale(1.05);
        }

        .btn-blue-custom {
            background: var(--blue-soft);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 700;
            border: none;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        /* List Group Premium */
        .list-group-item {
            border: none;
            margin-bottom: 12px;
            border-radius: 15px !important;
            background: white;
            transition: 0.3s;
            padding: 1.2rem !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .list-group-item:hover {
            background: #fff;
            transform: translateX(10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .btn-outline-secondary {
            border-radius: 50px;
            border-width: 2px;
            font-weight: 600;
        }

        footer {
            border-top: 5px solid var(--accent-yellow);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text fw-bold">PENDIDIKAN <span class="text-info">DKI JAKARTA</span></span>
            </a>
            <div class="ms-auto">
                <a href="dashboard.php" class="btn btn-outline-info text-white rounded-pill px-4 btn-sm fw-bold">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-graduation-cap fa-4x mb-3 text-white"></i>
            <h1 class="display-4 fw-bold mb-0">Layanan Pendidikan Warga</h1>
            <p class="lead mt-3 opacity-75">Sistem Terpadu Informasi Sekolah, Beasiswa, dan PPDB Online.</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--blue-dark);">Akses Cepat Layanan Sekolah</h2>
            <div class="mx-auto" style="width: 60px; height: 5px; background: var(--blue-soft); border-radius: 10px;">
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card feature-box h-100 info-card">
                    <div class="card-body text-center d-flex flex-column">
                        <div class="card-icon"><i class="fas fa-user-plus"></i></div>
                        <h5 class="card-title fw-bold" style="color: var(--blue-dark);">PPDB Online 2025</h5>
                        <p class="card-text small text-secondary flex-grow-1">Pendaftaran Peserta Didik Baru terpadu.
                            Pantau zonasi, seleksi administrasi, dan pengumuman hasil secara transparan.</p>
                        <a href="ppdb.php" class="btn btn-check-now mt-3">Cek PPDB Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card feature-box h-100 info-card" style="border-left-color: var(--blue-soft);">
                    <div class="card-body text-center d-flex flex-column">
                        <div class="card-icon" style="color: var(--blue-soft);"><i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h5 class="card-title fw-bold" style="color: var(--blue-dark);">Data Sekolah Terdekat</h5>
                        <p class="card-text small text-secondary flex-grow-1">Eksplorasi ribuan sekolah di Jakarta
                            melalui peta interaktif. Cek fasilitas, profil guru, hingga status akreditasi terkini.</p>
                        <a href="peta_sekolah.php" class="btn btn-blue-custom mt-3 text-white">Buka Peta Sekolah</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card feature-box h-100 info-card" style="border-left-color: var(--blue-soft);">
                    <div class="card-body text-center d-flex flex-column">
                        <div class="card-icon" style="color: var(--blue-soft);"><i class="fas fa-gift"></i></div>
                        <h5 class="card-title fw-bold" style="color: var(--blue-dark);">Portal Beasiswa & KJP</h5>
                        <p class="card-text small text-secondary flex-grow-1">Informasi lengkap KJP Plus, KJMU, dan
                            beasiswa unggulan lainnya untuk mendukung masa depan putra-putri Jakarta.</p>
                        <a href="beasiswa.php" class="btn btn-blue-custom mt-3 text-white">Cek Status Bantuan</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5 pt-4">
            <div class="col-lg-9">
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <h3 class="fw-bold mb-4 text-center" style="color: var(--blue-dark);">Portal Pendukung Pendidikan
                    </h3>
                    <div class="list-group list-group-flush">
                        <div
                            class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-subtle p-3 rounded-circle me-3">
                                    <i class="fas fa-book-open text-primary"></i>
                                </div>
                                <span class="fw-bold fs-6">Kurikulum & Materi Pembelajaran Online</span>
                            </div>
                            <a href="materi_online.php" class="btn btn-outline-secondary px-4">Akses Materi</a>
                        </div>

                        <div
                            class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger-subtle p-3 rounded-circle me-3">
                                    <i class="fas fa-bullhorn text-danger"></i>
                                </div>
                                <span class="fw-bold fs-6 text-danger">Layanan Pengaduan & Saber Pungli Sekolah</span>
                            </div>
                            <a href="lapor_sekolah.php" class="btn btn-outline-danger px-4 fw-bold">Lapor Sekarang</a>
                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth Hover & Animation Script
        document.querySelectorAll('.feature-box').forEach(card => {
            card.addEventListener('mouseenter', () => {
                // Interaktivitas tambahan bisa diletakkan di sini jika perlu
            });
        });

        // Simple Fade-in effect on Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.feature-box, .list-group-item').forEach(el => {
            el.style.opacity = 0;
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease-out';
            observer.observe(el);
        });
    </script>
</body>

</html>