<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jelajahi Jakarta - CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" /> 
    
    <style>
       
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
        }
        .map-placeholder {
            height: 500px; 
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #6c757d;
            margin-bottom: 30px;
        }
        .place-card {
            min-height: 100%;
            transition: transform 0.2s;
        }
        .place-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .place-card .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">JELAJAHI JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-torii-gate fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Jelajahi Jakarta: Wisata, Kuliner & Budaya</h1>
            <p class="lead mt-2">Temukan tempat-tempat unik dan acara seru di sekitar Ibu Kota.</p>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-4" style="color: var(--blue-dark); font-weight: 700;">Peta Tempat Menarik</h2>
        <div class="map-placeholder shadow rounded">
            [Peta Interaktif Jakarta - Di sini akan di-embed Google Maps atau OpenStreetMap]
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <div class="input-group input-group-lg">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Cari tempat wisata, museum, atau kuliner...">
                </div>
            </div>
            <div class="col-md-3">
                 <select class="form-select form-select-lg">
                    <option selected>Semua Kategori</option>
                    <option value="1">Wisata Budaya</option>
                    <option value="2">Kuliner Lokal</option>
                    <option value="3">Taman & Ruang Terbuka</option>
                    <option value="4">Acara & Event</option>
                </select>
            </div>
        </div>
    </div>

    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <h2 class="text-center mb-5" style="color: var(--blue-dark); font-weight: 700;">Destinasi Pilihan</h2>
            
            <div class="row g-4">
                
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm">
                        <img src="assets/kotatua.jpg" class="card-img-top" alt="Kota Tua">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Kota Tua</h5>
                            <p class="card-text small text-muted"><i class="fas fa-map-marker-alt"></i> Jakarta Barat</p>
                            <p class="card-text">Pusat sejarah kolonial Batavia, cocok untuk bersepeda dan menikmati museum. **Kategori:** Budaya & Sejarah.</p>
                            <a href="#" class="btn btn-sm" style="background-color: var(--blue-soft); color: white;">Lihat Detail Peta</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm">
                        <img src="assets/tmii.jpg" class="card-img-top" alt="Taman Mini">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Taman Mini Indonesia Indah (TMII)</h5>
                            <p class="card-text small text-muted"><i class="fas fa-map-marker-alt"></i> Jakarta Timur</p>
                            <p class="card-text">Edukasi budaya dan arsitektur dari seluruh provinsi di Indonesia dalam satu kawasan yang luas. **Kategori:** Edukasi & Rekreasi.</p>
                            <a href="#" class="btn btn-sm" style="background-color: var(--blue-soft); color: white;">Lihat Detail Peta</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-12">
                    <div class="card place-card shadow-sm">
                        <img src="assets/blok m.jpg" class="card-img-top" alt="M Bloc Space">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">M Bloc Space</h5>
                            <p class="card-text small text-muted"><i class="fas fa-map-marker-alt"></i> Jakarta Selatan</p>
                            <p class="card-text">Pusat kreatif anak muda dengan kuliner, musik, dan pameran. Sering mengadakan acara menarik. **Kategori:** Kuliner & Hiburan.</p>
                            <a href="#" class="btn btn-sm" style="background-color: var(--blue-soft); color: white;">Lihat Detail Peta</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <button class="btn btn-lg btn-outline-secondary">Tampilkan Destinasi Lainnya</button>
            </div>
        </div>
    </section>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - Jelajahi Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>