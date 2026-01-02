<?php
session_start();
// Pastikan file config.php berisi koneksi DB atau variabel tema jika diperlukan
require "config.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Antrean Faskes Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />

    <style>
        /* ============================= */
        /*  Faskes Page Styles           */
        /* ============================= */

        /* Card Faskes */
        .faskes-card {
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease,
                border-color 0.25s ease;
        }

        .faskes-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            border-color: var(--blue-soft);
        }

        /* Image */
        .faskes-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        /* ============================= */
        /*  Status Badge                 */
        /* ============================= */

        .badge-open {
            background-color: #198754 !important;
            /* Hijau */
        }

        .badge-close {
            background-color: #dc3545 !important;
            /* Merah */
        }

        /* ============================= */
        /*  Page Header                  */
        /* ============================= */

        .page-header {
            background-color: var(--blue-soft);
            color: #ffffff;
            padding: 40px 0;
            margin-bottom: 50px;
        }

        .faskes-list-section {
            padding-bottom: 50px;
        }

        /* ============================= */
        /*  Button Antrean               */
        /* ============================= */

        .btn-antrean {
            background-color: var(--blue-soft);
            border: 1px solid var(--blue-soft);
            color: #ffffff;
            font-weight: 600;
            transition:
                background-color 0.25s ease,
                border-color 0.25s ease,
                color 0.25s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .btn-antrean:hover {
            background-color: #ffffff;
            color: var(--blue-soft);
            border-color: var(--blue-soft);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }


        .text-accent {
            color: var(--blue-soft) !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">LAYANAN KESEHATAN DIGITAL</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="kesehatan.php" class="btn btn-outline-light btn-sm rounded-pill px-3"></i> KEMBALI</a>
            </div>
        </div>
    </nav>
    

    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-calendar-check fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Antrean Faskes Digital</h1>
            <p class="lead mt-2">
                Buat janji berobat ke fasilitas kesehatan tanpa perlu antre fisik di tempat.
            </p>
        </div>
    </section>

    <div class="container faskes-list-section">
        <div class="text-center mb-5">
            <h2 class="fw-bold" style="color: var(--blue-dark);">Pilih Fasilitas Kesehatan</h2>
            <p class="text-secondary">
                Antrean tersedia untuk Rumah Sakit Umum Daerah (RSUD) dan Puskesmas.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card faskes-card h-100 shadow-sm">
                    <img src="assets/rsud.jpg" alt="RSUD Jakarta">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Rumah Sakit</span>
                        <h5 class="card-title fw-bold text-accent">RSUD Jakarta Pusat</h5>

                        <p class="mb-1 small">
                            <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                            Jl. Medan Merdeka No.10, Jakarta Pusat
                        </p>

                        <p class="mb-1 small">
                            <i class="fas fa-clock me-2 text-secondary"></i>
                            08.00 – 20.00 WIB
                        </p>

                        <span class="badge badge-open mt-2">Buka</span>
                    </div>
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="ambil_antrean.php?faskes_id=1" class="btn btn-antrean w-100">
                            Ambil Antrean
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card faskes-card h-100 shadow-sm">
                    <img src="assets/puskesmas.jpg" alt="Puskesmas">
                    <div class="card-body">
                        <span class="badge bg-success mb-2">Puskesmas</span>
                        <h5 class="card-title fw-bold text-accent">Puskesmas Tanah Abang</h5>

                        <p class="mb-1 small">
                            <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                            Jl. KS Tubun No.5, Jakarta Pusat
                        </p>

                        <p class="mb-1 small">
                            <i class="fas fa-clock me-2 text-secondary"></i>
                            07.00 – 14.00 WIB
                        </p>

                        <span class="badge badge-open mt-2">Buka</span>
                    </div>
                    <div class="card-footer bg-white border-0 text-center">
                        <a href="ambil_antrean.php?faskes_id=2" class="btn btn-antrean w-100">
                            Ambil Antrean
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card faskes-card h-100 shadow-sm">
                    <img src="assets/klinik.png" alt="Klinik">
                    <div class="card-body">
                        <span class="badge bg-warning text-dark mb-2">Klinik</span>
                        <h5 class="card-title fw-bold text-secondary">Klinik Sehat Sentosa</h5>

                        <p class="mb-1 small">
                            <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                            Jl. Kebon Kacang No.12, Jakarta Pusat
                        </p>

                        <p class="mb-1 small">
                            <i class="fas fa-clock me-2 text-secondary"></i>
                            09.00 – 17.00 WIB
                        </p>

                        <span class="badge badge-close mt-2">Tutup</span>
                    </div>
                    <div class="card-footer bg-white border-0 text-center">
                        <button class="btn btn-secondary w-100" disabled>
                            Antrean Ditutup
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2025 CoreJKT - Layanan Kesehatan Digital.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>