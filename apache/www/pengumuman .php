<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengumuman Resmi - CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" /> 
    
    <style>
        /* CSS Khusus Pengumuman */
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 40px 0;
        }
        .announcement-item {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            transition: box-shadow 0.2s;
        }
        .announcement-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .announcement-date {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .urgency-badge {
            font-size: 0.9rem;
            font-weight: bold;
        }
        .urgency-penting {
            background-color: #dc3545; /* Merah untuk Penting */
            color: white;
        }
        .urgency-biasa {
            background-color: #0dcaf0; /* Cyan/Info untuk Normal */
            color: black;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">PENGUMUMAN RESMI PEMPROV DKI</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </nav>
    
    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-bullhorn fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">Pengumuman dan Pemberitahuan Resmi</h1>
            <p class="lead mt-2">Daftar pemberitahuan penting terkait kebijakan dan layanan publik.</p>
        </div>
    </section>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <div class="announcement-item shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="mb-1" style="color: var(--blue-dark);">Penyesuaian Tarif Retribusi Layanan Persampahan Tahun 2026</h4>
                            <p class="announcement-date">Diterbitkan: 10 Desember 2025</p>
                        </div>
                        <span class="badge urgency-penting p-2">PENTING</span>
                    </div>
                    <p class="mt-2 mb-3">
                        Berdasarkan Peraturan Gubernur No. X Tahun 2025, akan dilakukan penyesuaian tarif retribusi untuk layanan kebersihan dan pengelolaan sampah mulai 1 Januari 2026. Harap segera periksa rincian tarif baru.
                    </p>
                    <a href="#" class="btn btn-sm" style="background-color: var(--blue-soft); color: white;">Baca Detail Pergub</a>
                </div>

                <div class="announcement-item shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="mb-1" style="color: var(--blue-dark);">Pendaftaran Pelatihan Kerja Gratis Tahap 3 (Non-Gelar)</h4>
                            <p class="announcement-date">Diterbitkan: 01 Desember 2025</p>
                        </div>
                        <span class="badge urgency-biasa p-2">INFORMASI</span>
                    </div>
                    <p class="mt-2 mb-3">
                        Dinas Ketenagakerjaan membuka pendaftaran untuk pelatihan keterampilan non-gelar (seperti digital marketing dan coding) untuk meningkatkan daya saing warga Jakarta. Kuota terbatas.
                    </p>
                    <a href="#" class="btn btn-sm" style="background-color: var(--blue-soft); color: white;">Daftar Sekarang</a>
                </div>
                
                <div class="announcement-item shadow-sm">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="mb-1" style="color: var(--blue-dark);">Peringatan Cuaca Ekstrem: Hujan Lebat Disertai Angin Kencang</h4>
                            <p class="announcement-date">Diterbitkan: 25 November 2025</p>
                        </div>
                        <span class="badge bg-warning text-dark p-2">PERINGATAN</span>
                    </div>
                    <p class="mt-2 mb-3">
                        Warga Jakarta diimbau waspada terhadap potensi banjir dan pohon tumbang. Periksa fitur "Pantau Banjir" di CoreJKT secara berkala.
                    </p>
                    <a href="#" class="btn btn-sm btn-outline-secondary">Cek Pantau Banjir</a>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-lg btn-outline-secondary">Tampilkan Arsip Pengumuman</button>
                </div>

            </div>
        </div>
    </div>

    <footer class="text-white py-4 mt-5" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2024 CoreJKT - Pengumuman Resmi DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>