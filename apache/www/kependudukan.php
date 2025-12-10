<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kependudukan - Layanan CoreJKT</title>

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
            border-left: 5px solid #17a2b8; 
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
            color: #17a2b8; 
        }
        .urgent-card {
             border-left-color: #dc3545; 
        }
        .urgent-card .card-icon {
             color: #dc3545;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">KEPENDUDUKAN DKI JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-address-card fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Layanan Administrasi Kependudukan</h1>
            <p class="lead mt-2">Urus KTP, Kartu Keluarga, dan dokumen sipil lainnya secara mudah dan cepat.</p>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-5" style="color: var(--blue-dark); font-weight: 700;">Pengajuan Dokumen Utama</h2>
        
        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-id-card card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">KTP Elektronik (e-KTP)</h5>
                        <p class="card-text small text-secondary">Pengajuan KTP baru, perpanjangan, atau penggantian e-KTP yang rusak/hilang. Cek status percetakan.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: #17a2b8; color: white;">Ajukan KTP</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-users card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Kartu Keluarga (KK)</h5>
                        <p class="card-text small text-secondary">Pengurusan Kartu Keluarga baru, penambahan/pengurangan anggota, dan perubahan data KK.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: var(--blue-soft); color: white;">Urus KK</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-scroll card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Akta Kelahiran/Perkawinan/Cerai</h5>
                        <p class="card-text small text-secondary">Layanan pengajuan dan pencetakan Akta Sipil secara online. Termasuk Akta Kelahiran dan Perkawinan.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: #17a2b8; color: white;">Ajukan Akta</a>
                    </div>
                </div>
            </div>
        </div>
        
        <hr class="my-5">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="text-center mb-4" style="color: var(--blue-dark);">Layanan Tambahan & Kedaruratan</h3>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pindah Datang dan Perekaman Sidik Jari (Biometrik)
                        <a href="#" class="btn btn-sm btn-outline-secondary">Cek Jadwal Perekaman</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center urgent-card">
                        Pengurusan Akta Kematian (Urgent)
                        <a href="#" class="btn btn-sm btn-danger">Urus Akta Kematian</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Cek NIK dan Data Kependudukan Online
                        <a href="#" class="btn btn-sm btn-outline-secondary">Cek NIK</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - Layanan Kependudukan DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>