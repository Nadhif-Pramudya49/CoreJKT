<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CCTV Kota - CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" /> 
    
    <style>
        /* CSS Khusus Halaman CCTV */
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
        }
        .cctv-grid {
            display: grid;
            /* Tampilan 2x2 atau 3x3 untuk desktop */
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 15px;
        }
        .cctv-feed {
            position: relative;
            background-color: #000;
            color: white;
            aspect-ratio: 16 / 9; /* Rasio standar monitor */
            overflow: hidden;
            border: 3px solid var(--blue-dark);
        }
        .cctv-feed img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.7; /* Sedikit redup seperti feed malam/monitoring */
        }
        .cctv-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 5px 10px;
            font-size: 0.8rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cctv-status {
            color: #28a745; /* Hijau untuk status LIVE */
            font-weight: bold;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">PEMANTAUAN CCTV KOTA</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-video fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Live Monitoring CCTV Kota</h1>
            <p class="lead mt-2">Pantau kondisi lalu lintas dan keamanan di berbagai titik strategis Jakarta secara real-time.</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                 <h2 style="color: var(--blue-dark); font-weight: 700;">Spot Ramai Terkini (12 Feeds Aktif)</h2>
            </div>
            <div class="col-md-6 text-md-end">
                <select class="form-select d-inline-block" style="width: auto;">
                    <option selected>Filter Wilayah: Jakarta Pusat</option>
                    <option>Jakarta Selatan</option>
                    <option>Jakarta Timur</option>
                    <option>Jakarta Barat</option>
                    <option>Jakarta Utara</option>
                </select>
            </div>
        </div>
       
        <div class="cctv-grid">
            
            <div class="cctv-feed shadow">
                <img src="https://via.placeholder.com/640x360/000000/F0F0F0?text=MONAS+-+Live+Feed" alt="CCTV Monas">
                <div class="cctv-label">
                    <span><i class="fas fa-map-marker-alt"></i> Bundaran Monas</span>
                    <span class="cctv-status">LIVE <i class="fas fa-circle" style="font-size: 0.5rem;"></i></span>
                </div>
            </div>

            <div class="cctv-feed shadow">
                <img src="https://via.placeholder.com/640x360/000000/F0F0F0?text=BUNDARAN+HI+-+Live+Feed" alt="CCTV Bundaran HI">
                <div class="cctv-label">
                    <span><i class="fas fa-map-marker-alt"></i> Bundaran Hotel Indonesia</span>
                    <span class="cctv-status">LIVE <i class="fas fa-circle" style="font-size: 0.5rem;"></i></span>
                </div>
            </div>
            
            <div class="cctv-feed shadow">
                <img src="https://via.placeholder.com/640x360/000000/F0F0F0?text=JPO+Semanggi+-+Live+Feed" alt="CCTV Semanggi">
                <div class="cctv-label">
                    <span><i class="fas fa-map-marker-alt"></i> JPO Semanggi</span>
                    <span class="cctv-status">LIVE <i class="fas fa-circle" style="font-size: 0.5rem;"></i></span>
                </div>
            </div>

            <div class="cctv-feed shadow">
                <img src="https://via.placeholder.com/640x360/000000/F0F0F0?text=Gerbang+Tol+Cawang+-+Live+Feed" alt="CCTV Cawang">
                <div class="cctv-label">
                    <span><i class="fas fa-map-marker-alt"></i> Gerbang Tol Cawang</span>
                    <span class="cctv-status">LIVE <i class="fas fa-circle" style="font-size: 0.5rem;"></i></span>
                </div>
            </div>
            
            <div class="cctv-feed shadow">
                <img src="https://via.placeholder.com/640x360/000000/F0F0F0?text=Terminal+Blok+M+-+Live+Feed" alt="CCTV Blok M">
                <div class="cctv-label">
                    <span><i class="fas fa-map-marker-alt"></i> Terminal Blok M</span>
                    <span class="cctv-status">LIVE <i class="fas fa-circle" style="font-size: 0.5rem;"></i></span>
                </div>
            </div>
            
            <div class="cctv-feed shadow">
                <img src="https://via.placeholder.com/640x360/000000/F0F0F0?text=Kota+Tua+-+Live+Feed" alt="CCTV Kota Tua">
                <div class="cctv-label">
                    <span><i class="fas fa-map-marker-alt"></i> Kawasan Kota Tua</span>
                    <span class="cctv-status">LIVE <i class="fas fa-circle" style="font-size: 0.5rem;"></i></span>
                </div>
            </div>

            <div class="cctv-feed shadow">
                <img src="https://via.placeholder.com/640x360/000000/F0F0F0?text=Jalan+Sudirman+-+Live+Feed" alt="CCTV Sudirman">
                <div class="cctv-label">
                    <span><i class="fas fa-map-marker-alt"></i> Jalan Jend. Sudirman</span>
                    <span class="cctv-status">LIVE <i class="fas fa-circle" style="font-size: 0.5rem;"></i></span>
                </div>
            </div>

            <div class="cctv-feed shadow">
                <img src="https://via.placeholder.com/640x360/000000/F0F0F0?text=Kelapa+Gading+-+Live+Feed" alt="CCTV Kelapa Gading">
                <div class="cctv-label">
                    <span><i class="fas fa-map-marker-alt"></i> Perempatan Kelapa Gading</span>
                    <span class="cctv-status">LIVE <i class="fas fa-circle" style="font-size: 0.5rem;"></i></span>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <button class="btn btn-lg btn-outline-secondary">Tampilkan Lebih Banyak CCTV</button>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - CCTV Kota DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>