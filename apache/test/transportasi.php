<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transportasi Publik - Layanan CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />

    <style>
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
        }

        .feature-box {
            transition: all 0.3s ease;
            border-left: 5px solid #0d6efd;
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
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">TRANSPORTASI PUBLIK DKI JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke
                    Dashboard</a>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-bus fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Transportasi Publik Terintegrasi</h1>
            <p class="lead mt-2">Akses informasi rute, lacak posisi kendaraan, dan beli tiket secara digital.</p>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-5" style="color: var(--blue-dark); font-weight: 700;">Fitur Utama Transportasi</h2>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-location-arrow card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Live Tracking Kendaraan</h5>
                        <p class="card-text small text-secondary">Menampilkan posisi real-time bus Transjakarta, MRT,
                            dan LRT untuk perencanaan perjalanan yang lebih akurat.</p>
                        <a href="live_tracking.php" class="btn btn-sm mt-2"
                            style="background-color: #0d6efd; color: white;">Mulai Lacak</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-ticket-alt card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">E-Ticketing & Pembayaran</h5>
                        <p class="card-text small text-secondary">Memudahkan pembelian dan penggunaan tiket transportasi
                            publik secara digital yang cepat dan aman.</p>
                        <a href="eticket.php" class="btn btn-sm mt-2"
                            style="background-color: var(--blue-soft); color: white;">Beli Tiket</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card shadow-sm feature-box h-100 info-card">
                    <div class="card-body text-center">
                        <i class="fas fa-route card-icon"></i>
                        <h5 class="card-title fw-bold" style="color: var(--blue-soft);">Jadwal & Rute Terkini</h5>
                        <p class="card-text small text-secondary">Informasi lengkap mengenai jadwal keberangkatan, rute,
                            dan tarif untuk semua jenis angkutan umum di Jakarta.</p>
                        <a href="#" class="btn btn-sm mt-2" style="background-color: #0d6efd; color: white;">Cek Jadwal
                            Rute</a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5">

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h3 class="text-center mb-4" style="color: var(--blue-dark);">Informasi Lalu Lintas & Infrastruktur</h3>
                <ul class="list-group shadow-sm">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pantauan CCTV Lalu Lintas Kota
                        <a href="cctv.php" class="btn btn-sm btn-outline-secondary">Lihat CCTV</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Layanan Pelaporan Kendaraan Darurat (Ambulans, Pemadam) - Live Tracking
                        <a href="lapor.php" class="btn btn-sm btn-outline-danger">Lapor Darurat</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Informasi Penutupan Jalan & Rekayasa Lalin
                        <a href="#" class="btn btn-sm btn-outline-secondary">Cek Info Lalin</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2025 CoreJKT - Layanan Transportasi Publik DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>