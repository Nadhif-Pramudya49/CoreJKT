<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="id">
  <head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Portal CoreJKT</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
      <div class="container">
        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img
            src="assets/Logo1.png"
            alt="Logo CoreJKT"
            class="me-2"
            style="height: 80px"
          />
          <span class="brand-text">
            PORTAL PEMERINTAH PROVINSI <br />
            DKI JAKARTA
          </span>
        </a>

        <
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCoreJKT"
          aria-controls="navbarCoreJKT"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="navbarCoreJKT">
         
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"
                >Beranda</a
              >
            </li>

            
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="profilDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Profil
              </a>
              <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                <li><a class="dropdown-item" href="profil_daerah.php">Profil Daerah</a></li>
                <li><a class="dropdown-item" href="visi_misi.php">Visi & Misi</a></li>
                <li>
                  <a class="dropdown-item" href="#">Struktur Organisasi</a>
                </li>
              </ul>
            </li>

            
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="ppidDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                PPID
              </a>
              <ul class="dropdown-menu" aria-labelledby="ppidDropdown">
                <li><a class="dropdown-item" href="#">Informasi Publik</a></li>
                <li>
                  <a class="dropdown-item" href="#">Permohonan Informasi</a>
                </li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="infoDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Informasi dan Berita
              </a>
              <ul class="dropdown-menu" aria-labelledby="infoDropdown">
                <li>
                  <a class="dropdown-item" href="berita.php">Berita Terbaru</a>
                </li>
                <li><a class="dropdown-item" href="agenda_launch.php">Agenda Kegiatan</a></li>
                <li><a class="dropdown-item" href="pengumuman.php">Pengumuman</a></li>
              </ul>
            </li>

            
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="layananDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Layanan Publik
              </a>
              <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                <li><a class="dropdown-item" href="kesehatan.php">Layanan Kesehatan</a></li>

                  <a class="dropdown-item" href="transportasi.php">Layanan Transportasi</a>
                </li>
                <li><a class="dropdown-item" href="sosial.php">Layanan Pajak</a></li>
                <li>
                  <a class="dropdown-item" href="kependudukan.php">Layanan Kependudukan</a>
                </li>
              </ul>
            </li>
          </ul>

          
          <div class="d-flex align-items-center">
            <button class="btn btn-success-custom me-2" onclick="window.location='logout.php'">
             <i class="fas fa-sign-in-alt"></i> Logout
              </button>
 
            <div class="dropdown">
              <a
                class="nav-link dropdown-toggle btn btn-outline-light-custom my-2 my-lg-0"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i class="fas fa-globe"></i> Indonesia
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">English</a></li>
                <li><a class="dropdown-item" href="#">Betawi</a></li>
                <li><a class="dropdown-item" href="#">Sunda</a></li>
                <li><a class="dropdown-item" href="#">Jawa</a></li>
                <li><a class="dropdown-item" href="#">Bali</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <section class="hero-section">
      <div class="hero-overlay"></div>
      <div class="container hero-content">
        <h1 class="display-4 fw-bold mb-3">Selamat Datang di Portal Resmi</h1>
        <p class="lead mb-4">Pemerintah Provinsi Jakarta</p>
        <p class="mb-4">Temukan layanan publik dari Pemprov Jakarta</p>
        <div class="row justify-content-center">
          <div class="col-md-7">
            <div class="input-group input-group-lg hero-search">
              <span class="input-group-text"
                ><i class="fas fa-search"></i
              ></span>
              <input
                type="text"
                class="form-control"
                placeholder="Ketik untuk mencari..."
              />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="profil-highlight-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="assets/Jakarta.jpg" class="img-fluid rounded shadow-lg" alt="Monas Jakarta">
            </div>
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-3">Jakarta, Kota Kolaborasi</h2>
                <p class="lead text-secondary">
                    Sebagai pusat pemerintahan, bisnis, dan budaya, Provinsi DKI Jakarta terus berbenah
                    menjadi kota global yang maju, sejahtera, dan berkelanjutan.
                </p>
                <p>
                    Pelajari lebih lanjut tentang sejarah, visi, dan misi Pemerintah Provinsi DKI Jakarta
                    untuk mencapai Jakarta yang kita impikan bersama.
                </p>
                <a href="#" class="btn btn-primary-custom mt-3">Baca Profil Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="berita-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3">Informasi dan Berita Terbaru</h2>
            <p class="lead text-secondary">
                Ikuti perkembangan terkini, kebijakan baru, dan agenda kegiatan penting Pemerintah Provinsi Jakarta.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 berita-card">
                    <img src="assets/Transjakarta.jpg" class="card-img-top" alt="Ilustrasi berita">
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">Pemerintahan</span>
                        <h5 class="card-title">Pj. Gubernur Resmikan Pembangunan Transportasi Terintegrasi Baru</h5>
                        <p class="card-text text-muted small"><i class="far fa-calendar-alt me-1"></i> 10 Desember 2025</p>
                        <p class="card-text">Pembangunan MRT fase 3 dimulai, menghubungkan kawasan barat dan timur Jakarta untuk mengurangi kemacetan...</p>
                        <a href="#" class="text-primary-custom fw-bold text-decoration-none">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 berita-card">
                    <img src="assets/pajak.jpg" class="card-img-top" alt="Ilustrasi pengumuman">
                    <div class="card-body">
                        <span class="badge bg-danger mb-2">Pengumuman</span>
                        <h5 class="card-title">Batas Akhir Pembayaran Pajak Bumi Bangunan Diperpanjang</h5>
                        <p class="card-text text-muted small"><i class="far fa-calendar-alt me-1"></i> 5 Desember 2025</p>
                        <p class="card-text">Pemerintah Provinsi memberikan perpanjangan waktu bagi wajib pajak PBB hingga akhir bulan ini...</p>
                        <a href="#" class="text-primary-custom fw-bold text-decoration-none">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 berita-card">
                    <img src="assets/wifi.jpg" class="card-img-top" alt="Ilustrasi kegiatan">
                    <div class="card-body">
                        <span class="badge bg-info mb-2">Agenda</span>
                        <h5 class="card-title">Jakarta Mendapat Penghargaan Kota Paling Berkelanjutan Se-Asia Tenggara</h5>
                        <p class="card-text text-muted small"><i class="far fa-calendar-alt me-1"></i> 30 November 2025</p>
                        <p class="card-text">Pengakuan ini didasarkan pada inisiatif kota dalam pengelolaan limbah dan penggunaan energi terbarukan...</p>
                        <a href="#" class="text-primary-custom fw-bold text-decoration-none">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
             <a href="berita.php" class="btn btn-outline-secondary-custom">Lihat Semua Berita <i class="fas fa-list-alt ms-2"></i></a>
        </div>
    </div>
</section>

<section class="quick-stats-section py-5 text-black">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="mb-3 text-black">Jakarta dalam Angka</h2>
            <p class="lead">Data dan Statistik Cepat Mengenai Ibukota</p>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="stat-box p-4 rounded shadow-sm">
                    <i class="fas fa-city stat-icon mb-2"></i>
                    <h3 class="display-4 fw-bold mb-0" data-target="11.24">0</h3>
                    <p class="lead">Juta Penduduk</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box p-4 rounded shadow-sm">
                    <i class="fas fa-bus stat-icon mb-2"></i>
                    <h3 class="display-4 fw-bold mb-0" data-target="98">0</h3>
                    <p class="lead">Jalur Transjakarta</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box p-4 rounded shadow-sm">
                    <i class="fas fa-tree stat-icon mb-2"></i>
                    <h3 class="display-4 fw-bold mb-0" data-target="3000">0</h3>
                    <p class="lead">Taman Kota</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-box p-4 rounded shadow-sm">
                    <i class="fas fa-file-invoice stat-icon mb-2"></i>
                    <h3 class="display-4 fw-bold mb-0" data-target="245">0</h3>
                    <p class="lead">Layanan Online</p>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="#" class="btn btn-light btn-lg fw-bold">Kunjungi Portal Satu Data Jakarta</a>
        </div>
    </div>
</section>

    <section class="layanan-publik-section py-5">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="mb-3">Layanan Publik</h2>
          <p class="lead text-secondary">
            Dapatkan layanan publik untuk memenuhi kebutuhan masyarakat Jakarta
            dengan mudah
          </p>
        </div>

        <div class="row g-4 justify-content-center">
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="kesehatan.php" class="layanan-item">
              <i class="fas fa-heartbeat"></i>
              <h5>Kesehatan</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="pendidikan.php" class="layanan-item">
              <i class="fas fa-graduation-cap"></i>
              <h5>Pendidikan</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="transportasi.php
          " class="layanan-item">
              <i class="fas fa-bus-alt"></i>
              <h5>Transportasi Publik</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="sosial.php
          " class="layanan-item">
              <i class="fas fa-users"></i>
              <h5>Sosial</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="kependudukan.php
          " class="layanan-item">
              <i class="fas fa-address-card"></i>
              <h5>Kependudukan</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="#" class="layanan-item">
              <i class="fas fa-database"></i>
              <h5>Layanan Satu Data</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="#" class="layanan-item">
              <i class="fas fa-money-bill-wave"></i>
              <h5>Layanan Keuangan</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="jelajahjakarta.php
          " class="layanan-item">
              <i class="fas fa-torii-gate"></i>
              <h5>Jelajahi Jakarta</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="cctv.php" class="layanan-item">
              <i class="fas fa-video"></i>
              <h5>CCTV</h5>
            </a>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4 col-6">
            <a href="lapor.php" class="layanan-item">
              <i class="fas fa-bullhorn"></i>
              <h5>E-Lapor</h5>
            </a>
          </div>
        </div>
      </div>
    </section>

    <div class="accessibility-button">
      <i class="fas fa-wheelchair"></i>
    </div>
    <div class="popular-search-sidebar">
      <span>Pencarian Terpopuler</span>
    </div>
    <a href="#" class="ogp-local-button">
      <img src="assets/Logo1.png" alt="OGP Logo" style="height: 55px" />
      Design <br />
      Jakarta
    </a>

    <footer class="bg-dark text-black py-4">
      <div class="container text-center">
        <p>&copy; 2024 CoreJKT - Portal Pemerintah Provinsi DKI Jakarta.</p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      
    

      
      document
        .getElementById("logoutBtn")
        .addEventListener("click", function () {
          window.location.href = "index.php";
        });
    </script>
  </body>
</html>
