<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendidikan - Layanan CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" /> 
    
    <style>
        
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
        }
        .feature-box {
            transition: all 0.3s ease;
            border-left: 5px solid #ffc107; 
            cursor: pointer;
            min-height: 200px;
        }
        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .card-icon {
            font-size: 3rem;
            color: var(--blue-dark);
            margin-bottom: 15px;
        }
        .info-card .card-icon {
            color: #ffc107; 
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">PENDIDIKAN DKI JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-graduation-cap fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Layanan Pendidikan Warga</h1>
            <p class="lead mt-2">Akses informasi PPDB, beasiswa, dan data sekolah di seluruh wilayah DKI Jakarta.</p>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-5" style="color: var(--blue-dark); font-weight: 700;">Akses Cepat Layanan Sekolah</h2>
        
        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-user-plus card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">PPDB Online</h5>
                        <p class="card-text small text-secondary">Pendaftaran Peserta Didik Baru untuk SD, SMP, dan SMA/SMK Negeri. Cek jadwal, zonasi, dan hasil seleksi.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: #ffc107; color: var(--blue-dark); font-weight: bold;">Cek PPDB Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marked-alt card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Data Sekolah Terdekat</h5>
                        <p class="card-text small text-secondary">Temukan informasi dan lokasi (Peta) Sekolah Negeri maupun Swasta di wilayah Anda, lengkap dengan akreditasi.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: var(--blue-soft); color: white;">Lihat Peta Sekolah</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-gift card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Info Beasiswa Pendidikan</h5>
                        <p class="card-text small text-secondary">Informasi terbaru mengenai program beasiswa, KJP Plus, dan bantuan dana pendidikan lainnya dari Pemprov DKI.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: var(--blue-soft); color: white;">Cek Beasiswa</a>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="my-5">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="text-center mb-4" style="color: var(--blue-dark);">Portal Pendukung Pendidikan</h3>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kurikulum & Materi Pembelajaran Online
                        <a href="#" class="btn btn-sm btn-outline-secondary">Akses Materi</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Layanan Pengaduan Sekolah (Gratifikasi, Pungli, dst.)
                        <a href="#" class="btn btn-sm btn-outline-secondary">Lapor</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - Layanan Pendidikan DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>