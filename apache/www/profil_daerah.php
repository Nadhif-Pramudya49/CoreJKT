<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Daerah - DKI Jakarta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" /> 
    
    <style>
        
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
        }
        .content-section {
            padding: 60px 0;
            border-bottom: 1px solid #eee;
        }
        .section-title {
            color: var(--blue-dark);
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background-color: var(--blue-soft);
            margin-top: 5px;
        }
        .visi-misi-item {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }
        .visi-misi-item h5 {
            color: var(--blue-soft);
            font-weight: bold;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">PROFIL DAERAH DKI JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-city fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Profil Daerah Provinsi DKI Jakarta</h1>
            <p class="lead mt-2">Mengenal lebih dekat Ibu Kota Negara Indonesia.</p>
        </div>
    </section>

    <div class="container">

        <section class="content-section" id="sejarah">
            <h2 class="section-title">Sejarah Singkat</h2>
            <div class="row">
                <div class="col-lg-8">
                    <p class="lead text-secondary">
                        Jakarta, yang dulunya dikenal sebagai Sunda Kelapa (sebelum 1527), merupakan pusat perdagangan penting. Nama berganti menjadi Jayakarta setelah direbut oleh Fatahillah, lalu diubah menjadi Batavia oleh Belanda (VOC). 
                    </p>
                    <p>
                        Setelah kemerdekaan Indonesia, kota ini ditetapkan sebagai Ibu Kota negara dengan nama Jakarta. Statusnya sebagai Daerah Khusus Ibu Kota (DKI) menjadikannya pusat pemerintahan, bisnis, dan kebudayaan nasional. Perkembangan Jakarta yang pesat menjadikannya salah satu kota metropolitan terbesar di Asia Tenggara.
                    </p>
                </div>
                <div class="col-lg-4 text-center">
                    <img src="assets/DKI.jpeg" alt="Monas" class="img-fluid rounded shadow-sm">
                </div>
            </div>
        </section>

        <section class="content-section" id="visi-misi">
            <h2 class="section-title">Visi dan Misi Pemprov DKI Jakarta</h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="visi-misi-item">
                        <h5 class="mb-3"><i class="fas fa-eye me-2"></i> VISI: Jakarta Kota Maju, Lestari, dan Berbudaya</h5>
                        <p class="mb-0">
                            Mewujudkan kota yang modern, berkelanjutan, dan menjunjung tinggi nilai-nilai budaya lokal.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <h4 class="mt-4 mb-3" style="color: var(--blue-dark);">MISI</h4>
                    <ul class="list-group shadow-sm">
                        <li class="list-group-item">Mewujudkan tata kelola pemerintahan yang transparan, efektif, dan melayani.</li>
                        <li class="list-group-item">Membangun masyarakat yang sehat, cerdas, dan berdaya saing global.</li>
                        <li class="list-group-item">Menciptakan lingkungan hidup yang asri dan infrastruktur kota yang tangguh.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="content-section" id="struktur-organisasi">
            <h2 class="section-title">Struktur Organisasi (SKPD)</h2>
            <p class="text-secondary">
                Pemerintah Provinsi DKI Jakarta terdiri dari berbagai Satuan Kerja Perangkat Daerah (SKPD) yang bertanggung jawab atas layanan spesifik.
            </p>
            <div class="text-center mt-4">
                <div class="map-placeholder rounded shadow-sm" style="height: 400px;">
                    [Diagram Struktur Organisasi SKPD DKI Jakarta]
                </div>
                <a href="#" class="btn btn-lg mt-4" style="background-color: var(--blue-soft); color: white;">Unduh Dokumen Struktur Lengkap</a>
            </div>
        </section>

    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2025 CoreJKT - Profil Daerah DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>