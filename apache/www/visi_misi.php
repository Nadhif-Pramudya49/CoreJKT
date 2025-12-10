<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Visi & Misi - DKI Jakarta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" /> 
    
    <style>
        /* CSS Khusus Halaman Visi Misi */
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
        }
        .content-section {
            padding: 60px 0;
            border-bottom: 1px solid #eee;
        }
        .visi-box {
            background-color: var(--blue-dark);
            color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .misi-list {
            margin-top: 30px;
        }
        .misi-list .list-group-item {
            padding: 15px 20px;
            border-left: 5px solid var(--blue-soft);
            margin-bottom: 10px;
            font-size: 1.1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .misi-list .list-group-item i {
            color: var(--blue-dark);
            margin-right: 15px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">VISI & MISI DKI JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-bullseye fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Visi & Misi Pemerintah Provinsi DKI Jakarta</h1>
            <p class="lead mt-2">Arah pembangunan jangka menengah kota metropolitan.</p>
        </div>
    </section>

    <div class="container my-5">

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center mb-4" style="color: var(--blue-dark); font-weight: 700;">Visi</h2>
                <div class="visi-box text-center">
                    <h3 class="fw-bold mb-3"><i class="fas fa-quote-left me-2"></i> Jakarta Kota Maju, Lestari, dan Berbudaya</h3>
                    <p class="lead mb-0">
                        Mewujudkan kota yang modern, berkelanjutan, dan menjunjung tinggi nilai-nilai budaya lokal.
                    </p>
                </div>
                <div class="text-center mt-3 text-secondary">
                    <small>Ditetapkan dalam Rencana Pembangunan Jangka Menengah Daerah (RPJMD) DKI Jakarta.</small>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-lg-10">
                <h2 class="text-center mb-4" style="color: var(--blue-dark); font-weight: 700;">Misi</h2>
                <ul class="list-group list-group-flush misi-list">
                    <li class="list-group-item">
                        <i class="fas fa-check-circle"></i> Mewujudkan tata kelola pemerintahan yang transparan, efektif, dan melayani.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-check-circle"></i> Membangun masyarakat yang sehat, cerdas, dan berdaya saing global.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-check-circle"></i> Menciptakan lingkungan hidup yang asri dan infrastruktur kota yang tangguh.
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-check-circle"></i> Mengembangkan ekonomi kreatif dan sektor usaha mikro, kecil, dan menengah (UMKM).
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-check-circle"></i> Memperkuat persatuan dan kesatuan bangsa dalam keberagaman.
                    </li>
                </ul>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="profil_daerah.html" class="btn btn-lg" style="background-color: #f0f0f0; color: var(--blue-dark);"><i class="fas fa-arrow-left me-2"></i> Kembali ke Profil Daerah</a>
        </div>
    </div>

    <footer class="text-white py-4 mt-5" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - Visi & Misi DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>