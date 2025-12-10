<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sosial & Ekonomi - Layanan CoreJKT</title>

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
            min-height: 220px;
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
            color: #ffc107; /
        }
        
        .tax-card {
             border-left-color: #28a745; 
        }
        .tax-card .card-icon {
             color: #28a745;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">SOSIAL & EKONOMI DKI JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-hand-holding-usd fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Layanan Sosial, Pajak, dan Ekonomi</h1>
            <p class="lead mt-2">Akses cepat informasi tagihan, bantuan sosial, dan pantauan harga kebutuhan pokok.</p>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-5" style="color: var(--blue-dark); font-weight: 700;">Fitur Utama Ekonomi & Keuangan</h2>
        
        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100 tax-card">
                    <div class="card-body text-center">
                        <i class="fas fa-cash-register card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: #28a745;">Cek Tagihan Pajak Daerah</h5>
                        <p class="card-text small text-secondary">Cek dan bayar tagihan Pajak Bumi & Bangunan (PBB), Pajak Kendaraan, dan pajak daerah lainnya secara online.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: #28a745; color: white;">Cek Tagihan Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-balance-scale card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Pantauan Harga Pangan</h5>
                        <p class="card-text small text-secondary">Memantau harga bahan pokok (beras, minyak, daging, dll.) secara real-time di berbagai pasar di Jakarta.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: #ffc107; color: var(--blue-dark); font-weight: bold;">Lihat Harga Pasar</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-handshake card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Cek Bantuan Sosial & Bansos</h5>
                        <p class="card-text small text-secondary">Informasi dan pengecekan status penerima bantuan sosial, PKH, atau bantuan non-tunai lainnya dari Pemprov DKI.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: var(--blue-soft); color: white;">Cek Status Bansos</a>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="my-5">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="text-center mb-4" style="color: var(--blue-dark);">Layanan Kesejahteraan dan Pemberdayaan</h3>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Program Pemberdayaan UMKM & Pelatihan Kerja
                        <a href="#" class="btn btn-sm btn-outline-secondary">Info Pelatihan</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pelayanan Data Kemiskinan Terpadu
                        <a href="#" class="btn btn-sm btn-outline-secondary">Lihat Data</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Layanan Dukungan bagi Penyandang Disabilitas
                        <a href="#" class="btn btn-sm btn-outline-secondary">Akses Layanan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - Layanan Sosial & Ekonomi DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>