<?php
session_start();
require_once __DIR__ . "/config.php";

// Data Simulasi Artikel (Bisa diintegrasikan dengan Database tabel 'berita' atau 'artikel')
$artikel_list = [
    [
        "id" => 1,
        "judul" => "5 Cara Efektif Mencegah DBD di Musim Hujan",
        "kategori" => "Pencegahan Penyakit",
        "tanggal" => "25 Des 2025",
        "gambar" => "https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=60",
        "ringkasan" => "Memasuki musim hujan, warga Jakarta diimbau waspada terhadap nyamuk Aedes Aegypti. Berikut langkah 3M Plus yang harus dilakukan..."
    ],
    [
        "id" => 2,
        "judul" => "Menjaga Kesehatan Mental di Tengah Kesibukan Ibu Kota",
        "kategori" => "Kesehatan Mental",
        "tanggal" => "20 Des 2025",
        "gambar" => "https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=60",
        "ringkasan" => "Stres akibat kemacetan dan beban kerja bisa berdampak buruk. Pelajari teknik mindfulness sederhana yang bisa dilakukan di sela waktu kerja."
    ],
    [
        "id" => 3,
        "judul" => "Panduan Nutrisi: Makanan Super untuk Meningkatkan Imunitas",
        "kategori" => "Gaya Hidup Sehat",
        "tanggal" => "15 Des 2025",
        "gambar" => "https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=800&q=60",
        "ringkasan" => "Penuhi kebutuhan vitamin C dan Zinc Anda melalui konsumsi buah dan sayuran lokal. Simak daftar makanan yang direkomendasikan ahli gizi."
    ]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Artikel Kesehatan - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background-color: #f4f7f6;
        }

        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 50px 0;
            border-bottom: 5px solid var(--blue-dark);
        }

        .article-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
            background: white;
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .article-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .category-badge {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: var(--blue-soft);
        }

        .btn-read {
            color: var(--blue-soft);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .btn-read:hover {
            color: var(--blue-dark);
            text-decoration: underline;
        }

        .sidebar-card {
            border-radius: 15px;
            background: white;
            border: none;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">Portal Edukasi Kesehatan Masyarakat Jakarta.</span>
            </a>
            <div class="ms-auto">
                <a href="kesehatan.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <header class="page-header text-center">
        <div class="container">
            <i class="fas fa-book-medical fa-3x mb-3"></i>
            <h1 class="fw-bold">Edukasi & Tips Kesehatan</h1>
            <p class="lead">Informasi terpercaya untuk mewujudkan masyarakat Jakarta yang lebih sehat.</p>
        </div>
    </header>

    <div class="container my-5">
        <div class="row g-4">
            <div class="col-lg-8">
                <h4 class="fw-bold mb-4" style="color: var(--blue-dark);">Artikel Terbaru</h4>

                <?php foreach ($artikel_list as $a): ?>
                    <div class="card article-card shadow-sm mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= $a['gambar']; ?>" class="article-img" alt="Thumbnail">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="category-badge"><?= $a['kategori']; ?></span>
                                        <small class="text-muted"><?= $a['tanggal']; ?></small>
                                    </div>
                                    <h4 class="card-title fw-bold mb-3" style="color: var(--blue-dark);"><?= $a['judul']; ?>
                                    </h4>
                                    <p class="card-text text-secondary small mb-4"><?= $a['ringkasan']; ?></p>
                                    <a href="#" class="btn-read">Baca Selengkapnya <i
                                            class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <nav aria-label="Navigasi halaman">
                    <ul class="pagination justify-content-center mt-5">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#"
                                style="background-color: var(--blue-soft); border-color: var(--blue-soft);">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-lg-4">
                <div class="card sidebar-card shadow-sm p-4 mb-4">
                    <h6 class="fw-bold mb-3">Cari Informasi</h6>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Ketik topik kesehatan...">
                        <button class="btn btn-primary" style="background-color: var(--blue-soft);"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="card sidebar-card shadow-sm p-4">
                    <h6 class="fw-bold mb-3">Kategori Terpopuler</h6>
                    <div class="list-group list-group-flush">
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                            Gaya Hidup Sehat <span class="badge bg-light text-muted rounded-pill">12</span>
                        </a>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                            Info Penyakit <span class="badge bg-light text-muted rounded-pill">8</span>
                        </a>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                            Kesehatan Anak <span class="badge bg-light text-muted rounded-pill">5</span>
                        </a>
                        <a href="#"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center px-0">
                            Nutrisi & Diet <span class="badge bg-light text-muted rounded-pill">10</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-4 bg-white border-top mt-5 text-center text-muted small">
        <div class="container">
            &copy; 2025 CoreJKT - Portal Edukasi Kesehatan Masyarakat Jakarta.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>