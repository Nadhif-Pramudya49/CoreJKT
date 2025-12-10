<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adenda Kegiatan - Peluncuran CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" /> 
    
    <style>
        /* CSS Khusus Adenda */
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
        }
        .rundown-item {
            border-left: 4px solid var(--blue-soft);
            padding: 15px 20px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        .rundown-item h5 {
            color: var(--blue-dark);
            font-weight: 700;
        }
        .time-box {
            background-color: var(--blue-dark);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">ADENDA KEGIATAN</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-calendar-alt fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Adenda Susunan Acara Peluncuran CoreJKT</h1>
            <p class="lead mt-2">Detail acara resmi peluncuran platform integrasi layanan publik.</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="row mb-5">
            <div class="col-md-6">
                <h4 style="color: var(--blue-dark);"><i class="fas fa-info-circle me-2"></i> Detail Acara</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Kegiatan:</strong> Peluncuran Resmi CoreJKT V.1.0</li>
                    <li class="list-group-item"><strong>Tanggal:</strong> Sabtu, 14 Desember 2025</li>
                    <li class="list-group-item"><strong>Waktu:</strong> 09.00 - 12.00 WIB</li>
                    <li class="list-group-item"><strong>Tempat:</strong> Balai Kota DKI Jakarta, Ruang Pola</li>
                    <li class="list-group-item"><strong>Peserta:</strong> Pejabat Pemprov DKI, Media, Tokoh Masyarakat</li>
                </ul>
            </div>
            <div class="col-md-6">
                 <h4 style="color: var(--blue-dark);"><i class="fas fa-users me-2"></i> Pembicara Utama</h4>
                 <ul class="list-group list-group-flush">
                    <li class="list-group-item">Kepala Dinas Komunikasi, Informatika, dan Statistik (Kadis Kominfotik)</li>
                    <li class="list-group-item">Pejabat Gubernur Provinsi DKI Jakarta</li>
                    <li class="list-group-item">Perwakilan Kemenpan-RB (Tentatif)</li>
                    <li class="list-group-item">Tim Pengembang (Technical Lead)</li>
                </ul>
            </div>
        </div>

        <h3 class="text-center mb-5" style="color: var(--blue-dark); font-weight: 700;">Susunan Acara (Rundown)</h3>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="rundown-item shadow-sm">
                    <span class="time-box">09:00 - 09:30</span>
                    <h5>Registrasi Peserta & Coffee Morning</h5>
                    <p class="mb-0 small text-secondary">Penyambutan tamu undangan dan media, sesi foto di *photo booth* CoreJKT.</p>
                </div>
                
                <div class="rundown-item shadow-sm">
                    <span class="time-box">09:30 - 09:45</span>
                    <h5>Pembukaan Resmi & Sambutan Awal</h5>
                    <p class="mb-0 small text-secondary">Pembukaan oleh MC, Lagu Kebangsaan Indonesia Raya, dan Sambutan Pengantar dari Kadis Kominfotik.</p>
                </div>

                <div class="rundown-item shadow-sm">
                    <span class="time-box">09:45 - 10:15</span>
                    <h5>Paparan Teknis dan Demo Produk</h5>
                    <p class="mb-0 small text-secondary">Presentasi fitur utama CoreJKT (E-Lapor, Live Tracking, Faskes) oleh Tim Technical Lead.</p>
                </div>

                <div class="rundown-item shadow-sm">
                    <span class="time-box">10:15 - 10:45</span>
                    <h5>Keynote Speech: Visi Integrasi Layanan</h5>
                    <p class="mb-0 small text-secondary">Penyampaian arahan dan Visi Digitalisasi Layanan Publik oleh Pejabat Gubernur DKI Jakarta.</p>
                </div>
                
                <div class="rundown-item shadow-sm" style="border-left-color: #dc3545; background-color: #fff0f0;">
                    <span class="time-box" style="background-color: #dc3545;">10:45 - 11:00</span>
                    <h5 class="text-danger">Sesi Peluncuran dan Penekanan Tombol Peresmian</h5>
                    <p class="mb-0 small text-secondary">Secara simbolis menandai dimulainya penggunaan CoreJKT secara resmi oleh publik.</p>
                </div>
                
                <div class="rundown-item shadow-sm">
                    <span class="time-box">11:00 - 11:30</span>
                    <h5>Sesi Tanya Jawab (Q&A)</h5>
                    <p class="mb-0 small text-secondary">Diskusi interaktif antara media/peserta dengan Pejabat dan Tim Teknis CoreJKT.</p>
                </div>
                
                <div class="rundown-item shadow-sm">
                    <span class="time-box">11:30 - 12:00</span>
                    <h5>Penutup & Sesi Ramah Tamah</h5>
                    <p class="mb-0 small text-secondary">Doa penutup, penyerahan cinderamata, dan santap siang bersama.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-4 mt-5" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - Adenda Kegiatan Peluncuran.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>