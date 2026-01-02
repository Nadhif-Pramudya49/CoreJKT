<?php
session_start();
require_once __DIR__ . "/config.php";

// Data Simulasi Materi Pembelajaran
$materi_list = [
    [
        "tingkat" => "SD / MI",
        "mapel" => "Matematika - Kurikulum Merdeka",
        "deskripsi" => "Modul pembelajaran interaktif mengenai bilangan cacah dan geometri dasar.",
        "icon" => "fa-calculator",
        "warna" => "text-primary"
    ],
    [
        "tingkat" => "SMP / MTs",
        "mapel" => "Bahasa Inggris - Digital Content",
        "deskripsi" => "Latihan listening dan struktur teks untuk persiapan ujian sekolah.",
        "icon" => "fa-language",
        "warna" => "text-success"
    ],
    [
        "tingkat" => "SMA / SMK",
        "mapel" => "Teknologi Informasi & Komunikasi",
        "deskripsi" => "Materi dasar pemrograman web dan pengenalan kecerdasan buatan (AI).",
        "icon" => "fa-laptop-code",
        "warna" => "text-danger"
    ],
    [
        "tingkat" => "Guru & Pengajar",
        "mapel" => "Panduan Implementasi Kurikulum",
        "deskripsi" => "Video workshop dan materi pelatihan perangkat pembelajaran terbaru.",
        "icon" => "fa-chalkboard-teacher",
        "warna" => "text-warning"
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Materi Pembelajaran Online - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body { background-color: #f4f7f9; }
        
        .page-header {
            background-color: var(--blue-soft);
            color: white;
            padding: 50px 0;
            border-bottom: 5px solid var(--blue-dark);
        }

        .content-card {
            border: none;
            border-radius: 20px;
            transition: 0.3s;
            background: white;
        }

        .content-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.8rem;
        }

        .btn-access {
            background-color: var(--blue-soft);
            color: white;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-access:hover {
            background-color: var(--blue-dark);
            color: white;
        }

        .subject-tag {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--blue-soft);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
            <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
            <span class="brand-text fw-bold">PORTAL MATERI</span>
        </a>
        <div class="ms-auto">
            <a href="pendidikan.php" class="btn btn-outline-light btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</nav>

<header class="page-header text-center">
    <div class="container">
        <i class="fas fa-book-open fa-3x mb-3"></i>
        <h1 class="fw-bold">Kurikulum & Materi Online</h1>
        <p class="lead">Akses sumber belajar digital gratis untuk seluruh siswa dan pendidik di Jakarta.</p>
    </div>
</header>

<div class="container my-5">
    <div class="row justify-content-center mb-5">
        <div class="col-md-7">
            <div class="bg-white p-2 rounded-pill shadow-sm d-flex border">
                <input type="text" class="form-control border-0 px-4" placeholder="Cari materi pelajaran (Misal: Biologi SMA)...">
                <button class="btn btn-primary rounded-pill px-4" style="background-color: var(--blue-soft);"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php foreach ($materi_list as $m): ?>
        <div class="col-lg-3 col-md-6">
            <div class="card content-card h-100 shadow-sm p-4 text-center">
                <div class="icon-circle shadow-sm">
                    <i class="fas <?= $m['icon'] ?> <?= $m['warna'] ?>"></i>
                </div>
                <span class="subject-tag mb-2"><?= $m['tingkat'] ?></span>
                <h5 class="fw-bold mb-3" style="color: var(--blue-dark);"><?= $m['mapel'] ?></h5>
                <p class="small text-muted mb-4"><?= $m['deskripsi'] ?></p>
                <div class="mt-auto">
                    <a href="#" class="btn btn-access w-100">Buka Materi</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-5 pt-4">
        <h3 class="fw-bold mb-4" style="color: var(--blue-dark);">Video Pembelajaran Terbaru</h3>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="rounded-4 overflow-hidden shadow-sm bg-dark" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-play-circle fa-4x text-white opacity-50"></i>
                </div>
                <p class="mt-3 fw-bold small">Tutorial Matematika Dasar - SD</p>
            </div>
            <div class="col-md-4">
                <div class="rounded-4 overflow-hidden shadow-sm bg-dark" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-play-circle fa-4x text-white opacity-50"></i>
                </div>
                <p class="mt-3 fw-bold small">Percobaan Fisika Sederhana - SMP</p>
            </div>
            <div class="col-md-4">
                <div class="rounded-4 overflow-hidden shadow-sm bg-dark" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-play-circle fa-4x text-white opacity-50"></i>
                </div>
                <p class="mt-3 fw-bold small">Workshop Coding Python - SMA</p>
            </div>
        </div>
    </div>
</div>

<footer class="py-4 bg-white border-top mt-5 text-center text-muted small">
    <div class="container">
        &copy; 2025 CoreJKT - Digital Learning Center DKI Jakarta.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>