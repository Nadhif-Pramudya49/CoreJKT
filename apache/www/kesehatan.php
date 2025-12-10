<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kesehatan - Layanan CoreJKT</title>

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
            border-left: 5px solid var(--blue-soft);
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
        .emergency-card {
            background-color: #f8d7da;
            border-left-color: #dc3545;
        }
        .emergency-card .card-icon {
            color: #dc3545;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">KESEHATAN DKI JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-heartbeat fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Layanan Kesehatan Warga</h1>
            <p class="lead mt-2">Buat janji, temukan fasilitas, dan akses bantuan darurat.</p>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-5" style="color: var(--blue-dark); font-weight: 700;">Pilihan Layanan Cepat</h2>
        
        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-check card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Antrean Faskes Digital</h5>
                        <p class="card-text small text-secondary">Buat janji berobat ke Puskesmas atau Rumah Sakit tanpa perlu antre fisik di tempat. Lihat kuota dan jadwal dokter.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: var(--blue-soft); color: white;">Buat Janji Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marker-alt card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Peta Faskes Terdekat</h5>
                        <p class="card-text small text-secondary">Temukan lokasi Rumah Sakit, Puskesmas, Klinik, dan Apotek terdekat berdasarkan lokasi Anda saat ini.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: var(--blue-soft); color: white;">Lihat Peta</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm feature-box emergency-card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-ambulance card-icon"></i>
                        <h5 class="card-title fw-bold text-danger">Panggilan Darurat Medis (112 / 119)</h5>
                        <p class="card-text small text-secondary">Akses cepat ke layanan medis darurat dan ambulans. Jangan ragu menghubungi jika ada kondisi kritis.</p>
                        <a href="tel:112" class="btn btn-danger mt-2"><i class="fas fa-phone"></i> Hubungi 112</a>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="my-5">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="text-center mb-4" style="color: var(--blue-dark);">Informasi Kesehatan Penting</h3>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Jadwal Vaksinasi COVID-19 & Influenza
                        <a href="#" class="btn btn-sm btn-outline-secondary">Cek Jadwal</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Daftar BPJS Kesehatan dan Cek Status Kepesertaan
                        <a href="#" class="btn btn-sm btn-outline-secondary">Cek BPJS</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Edukasi Kesehatan dan Tips Hidup Sehat
                        <a href="#" class="btn btn-sm btn-outline-secondary">Baca Artikel</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - Layanan Kesehatan DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>