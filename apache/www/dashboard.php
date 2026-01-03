<?php
session_start();
?>


<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Portal CoreJKT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<script>

  const searchInput = document.querySelector('.hero-search input');
  const layananItems = document.querySelectorAll('.layanan-item');

  if (searchInput) {
    searchInput.addEventListener('input', function (e) {
      const searchTerm = e.target.value.toLowerCase().trim();

      if (searchTerm === '') {

        layananItems.forEach(item => {
          item.parentElement.style.display = 'block';
        });
        return;
      }


      let foundCount = 0;
      layananItems.forEach(item => {
        const layananName = item.querySelector('h5').textContent.toLowerCase();

        if (layananName.includes(searchTerm)) {
          item.parentElement.style.display = 'block';
          item.style.animation = 'fadeIn 0.5s ease';
          foundCount++;
        } else {
          item.parentElement.style.display = 'none';
        }
      });


      if (searchTerm !== '') {
        document.querySelector('.layanan-publik-section').scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });


    searchInput.addEventListener('keypress', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        document.querySelector('.layanan-publik-section').scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  }
</script>

<style>
  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<style>
  .counter,
  .stat-box h3,
  .stat-box h3 span {
    color: #000000 !important;

  }


  .stat-box .lead {
    color: #333333 !important;
  }


  .stat-box {
    background-color: #ffffff !important;
    border: 1px solid #dee2e6;
  }

  /* Fitur belum tersedia */
  .disabled-feature {
    filter: grayscale(100%);
    opacity: 0.55;
    cursor: not-allowed;
    pointer-events: auto;
    /* tetap bisa diklik buat modal */
    transition: all 0.3s ease;
  }

  .disabled-feature:hover {
    opacity: 0.6;
    transform: none;
  }

  /* Icon & teks */
  .disabled-feature i,
  .disabled-feature h5 {
    color: #6c757d !important;
  }

  /* Badge */
  .disabled-feature .badge {
    font-size: 0.65rem;
  }

  /* -------------------------------- */
  .layanan-publik-section {
    background-color: #fcfdfe;
  }

  /* Container Utama Item */
  .layanan-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 25px 15px;
    border-radius: 20px;
    background: #ffffff;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid #f0f0f0;
    height: 100%;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
  }

  /* Efek Hover: Terangkat dan Berwarna */
  .layanan-item:hover {
    transform: translateY(-12px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    border-color: transparent;
    text-decoration: none;
  }

  /* Desain Ikon */
  .layanan-item i {
    font-size: 2.5rem;
    margin-bottom: 15px;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #0d6efd, #0dcaf0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .layanan-item h5 {
    font-size: 0.95rem;
    font-weight: 700;
    color: #333;
    margin: 0;
    transition: color 0.3s ease;
  }

  /* Variasi Warna per Item agar Lebih Hidup */
  .item-kesehatan i {
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    -webkit-background-clip: text;
  }

  .item-pendidikan i {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    -webkit-background-clip: text;
  }

  .item-transportasi i {
    background: linear-gradient(135deg, #f2994a, #f2c94c);
    -webkit-background-clip: text;
  }

  .item-keuangan i {
    background: linear-gradient(135deg, #11998e, #38ef7d);
    -webkit-background-clip: text;
  }

  .item-jelajah i {
    background: linear-gradient(135deg, #8e2de2, #4a00e0);
    -webkit-background-clip: text;
  }

  .item-cctv i {
    background: linear-gradient(135deg, #2c3e50, #000000);
    -webkit-background-clip: text;
  }

  .item-lapor i {
    background: linear-gradient(135deg, #eb3349, #f45c43);
    -webkit-background-clip: text;
  }

  .item-cuaca i {
    background: linear-gradient(135deg, #2193b0, #6dd5ed);
    -webkit-background-clip: text;
  }

  /* Style untuk fitur yang belum tersedia */
  .disabled-feature {
    opacity: 0.7;
    filter: grayscale(0.5);
    cursor: not-allowed;
  }

  .badge-coming {
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 50px;
    padding: 4px 10px;
  }
</style>


<style>
  .profil-highlight-section {
    position: relative;
    overflow: hidden;
    background: linear-gradient(to right, #ffffff, #f8f9fa);
  }

  /* Dekorasi Lingkaran di Belakang Gambar */
  .image-stack {
    position: relative;
    display: inline-block;
  }

  .image-stack::before {
    content: "";
    position: absolute;
    width: 110%;
    height: 110%;
    background: rgba(13, 110, 253, 0.05);
    border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
    top: -5%;
    left: -5%;
    z-index: 0;
    animation: morph 8s linear infinite forwards;
  }

  @keyframes morph {
    0% {
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
    }

    25% {
      border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%;
    }

    50% {
      border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%;
    }

    75% {
      border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;
    }

    100% {
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
    }
  }

  .main-img {
    position: relative;
    z-index: 2;
    transition: all 0.5s ease;
    border-radius: 20px;
  }

  .main-img:hover {
    transform: scale(1.03) rotate(1deg);
  }

  /* Floating Info Card */
  .floating-info {
    position: absolute;
    bottom: 20px;
    right: -10px;
    background: white;
    padding: 15px 25px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    z-index: 3;
    border-left: 5px solid #ffc107;
    animation: float 3s ease-in-out infinite;
  }

  @keyframes float {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-10px);
    }
  }

  .btn-gradient {
    background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    color: white !important;
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
  }

  .btn-gradient:hover {
    transform: translateX(5px);
    box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
  }

  .fa-play-circle {
    transition: all 0.3s ease;
  }

  .btn-link:hover .fa-play-circle {
    transform: scale(1.2);
    filter: drop-shadow(0 0 8px rgba(220, 53, 69, 0.6));
    animation: pulse-red 1.5s infinite;
  }

  @keyframes pulse-red {
    0% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.2);
    }

    100% {
      transform: scale(1);
    }
  }

  /* Biar modal terlihat sangat premium */
  #videoProfileModal .modal-content {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
  }
</style>
<style>
  /* Animasi kecil biar tombolnya terlihat 'hidup' */
  .ogp-local-button {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: white;
    transition: all 0.3s ease;
  }

  .ogp-local-button:hover {
    transform: scale(1.05);
    filter: drop-shadow(0 0 10px rgba(0, 210, 255, 0.5));
  }
</style>


<body>
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3 sticky-top">
    <div class="container"> <a class="navbar-brand d-flex align-items-center" href="#"> <img src="assets/Logo1.png"
          alt="Logo CoreJKT" class="me-2" style="height: 40px" /> <span class="brand-text"> PORTAL PEMERINTAH PROVINSI
          <br /> DKI JAKARTA </span> </a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarCoreJKT" aria-controls="navbarCoreJKT" aria-expanded="false"
        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarCoreJKT">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item"> <a class="nav-link active" aria-current="page" href="#">Beranda</a> </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false"> Profil </a>
            <ul class="dropdown-menu" aria-labelledby="profilDropdown">
              <li><a class="dropdown-item" href="profil_daerah.php">Profil Daerah</a></li>
              <li><a class="dropdown-item" href="visi_misi.php">Visi & Misi</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="infoDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false"> Informasi dan Berita </a>
            <ul class="dropdown-menu" aria-labelledby="infoDropdown">
              <li> <a class="dropdown-item" href="berita.php">Berita Terbaru</a> </li>
              <li><a class="dropdown-item" href="agenda_launch.php">Agenda Kegiatan</a></li>
              <li><a class="dropdown-item" href="pengumuman.php">Pengumuman</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" id="layananDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false"> Layanan Publik </a>
            <ul class="dropdown-menu" aria-labelledby="layananDropdown">
              <li><a class="dropdown-item" href="kesehatan.php">Layanan Kesehatan</a></li> <a class="dropdown-item"
                href="transportasi.php">Layanan Transportasi</a>
          </li>
          <li><a class="dropdown-item" href="pendidikan.php">Layanan Pendidikan</a></li>
          <li><a class="dropdown-item" href="lapor.php">Layanan E-Lapor</a></li>
        </ul>
        </li>
        </ul>
        <div class="d-flex align-items-center">
          <?php if (isset($_SESSION['user'])): ?>
            <div class="dropdown me-3">
              <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Halo, <?= htmlspecialchars($_SESSION['user']['nama']) ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">

                <li><a class="dropdown-item" href="edit_akun.php?id=<?= $_SESSION['user']['id'] ?>"><i
                      class="fas fa-user-edit me-2"></i> Edit Akun</a></li>
                <li><a class="dropdown-item text-danger" href="hapus_akun.php?id=<?= $_SESSION['user']['id'] ?>"
                    onclick="return confirm('Yakin ingin menghapus akun?')"><i class="fas fa-trash me-2"></i> Hapus
                    Akun</a></li>
              </ul>
            </div>
            <a href="logout.php" class="btn btn-danger me-2"> <i class="fas fa-sign-out-alt"></i> Logout </a>
          <?php else: ?>
            <a href="login.php" class="btn btn-success-custom me-2"> <i class="fas fa-sign-in-alt"></i> Login </a>
          <?php endif; ?>
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
          <form action="search.php" method="GET" class="input-group input-group-lg hero-search">
            <span class="input-group-text"><i></i></span>
            <input type="text" name="q" class="form-control" placeholder="Ketik untuk mencari..." required />
            <button type="submit" class="btn btn-primary" style="background-color: var(--blue-soft); border: none;">
              Cari
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>


  <section class="layanan-publik-section py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold mb-2" style="color: #051025;">Layanan Publik</h2>
        <div class="mx-auto mb-3" style="width: 60px; height: 4px; background: #ffc107; border-radius: 2px;"></div>
        <p class="lead text-secondary col-lg-8 mx-auto">
          Akses berbagai solusi kebutuhan masyarakat Jakarta dalam satu platform digital yang terintegrasi.
        </p>
      </div>

      <div class="row g-4 justify-content-center">
        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="kesehatan.php" class="layanan-item item-kesehatan">
            <i class="fas fa-heartbeat"></i>
            <h5>Kesehatan</h5>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="pendidikan.php" class="layanan-item item-pendidikan">
            <i class="fas fa-graduation-cap"></i>
            <h5>Pendidikan</h5>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="transportasi.php" class="layanan-item item-transportasi">
            <i class="fas fa-bus-alt"></i>
            <h5>Transportasi</h5>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="#" class="layanan-item disabled-feature" data-bs-toggle="modal" data-bs-target="#maintenanceModal">
            <i class="fas fa-address-card" style="background: #6c757d; -webkit-background-clip: text;"></i>
            <h5>Data Warga</h5>
            <span class="badge bg-light text-dark border badge-coming mt-2">Coming Soon</span>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="laporan_keuangan.php" class="layanan-item item-keuangan">
            <i class="fas fa-money-bill-wave"></i>
            <h5>Keuangan</h5>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="jelajahjakarta.php" class="layanan-item item-jelajah">
            <i class="fas fa-torii-gate"></i>
            <h5>Jelajah JKT</h5>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="cctv.php" class="layanan-item item-cctv">
            <i class="fas fa-video"></i>
            <h5>CCTV Kota</h5>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="lapor.php" class="layanan-item item-lapor">
            <i class="fas fa-bullhorn"></i>
            <h5>E-Lapor</h5>
          </a>
        </div>

        <div class="col-lg-2 col-md-3 col-sm-4 col-6">
          <a href="cuaca.php" class="layanan-item item-cuaca">
            <i class="fas fa-cloud-sun"></i>
            <h5>Info Cuaca</h5>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="profil-highlight-section py-5">
    <div class="container py-lg-5">
      <div class="row align-items-center">

        <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
          <div class="image-stack">
            <img src="assets/Jakarta.jpg" class="img-fluid main-img shadow-lg" alt="Monas Jakarta">

            <div class="floating-info d-none d-md-block text-start">
              <div class="d-flex align-items-center gap-3">
                <div class="icon-circle bg-warning-subtle p-2 rounded-circle">
                  <i class="fas fa-users text-warning"></i>
                </div>
                <div>
                  <h6 class="mb-0 fw-bold">10.6 Juta+</h6>
                  <small class="text-muted">Penduduk Jakarta</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 ps-lg-5">
          <div
            class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3 fw-bold text-uppercase tracking-wider">
            <i class="fas fa-city me-2"></i> Profil Kota
          </div>
          <h2 class="display-4 fw-bold mb-4" style="color: #051025; line-height: 1.2;">
            Jakarta, Kota <span class="text-primary">Kolaborasi</span> Global
          </h2>

          <p class="lead text-dark mb-4 fw-medium">
            Sebagai pusat pemerintahan, bisnis, dan budaya, Provinsi DKI Jakarta terus bertransformasi menjadi kota
            global yang maju dan berkelanjutan.
          </p>

          <div class="row mb-4">
            <div class="col-6">
              <div class="d-flex align-items-start mb-3">
                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                <span>Infrastruktur Modern</span>
              </div>
              <div class="d-flex align-items-start">
                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                <span>Pusat Ekonomi Nasional</span>
              </div>
            </div>
            <div class="col-6">
              <div class="d-flex align-items-start mb-3">
                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                <span>Keberagaman Budaya</span>
              </div>
              <div class="d-flex align-items-start">
                <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                <span>Kota Pintar (Smart City)</span>
              </div>
            </div>
          </div>

          <p class="text-secondary mb-4">
            Pelajari lebih lanjut tentang sejarah panjang, visi ambisius, dan misi strategis Pemerintah Provinsi DKI
            Jakarta untuk mewujudkan masa depan Jakarta yang lebih cerah bagi kita semua.
          </p>

          <div class="d-flex flex-column flex-sm-row gap-3">
            <a href="profil_daerah.php" target="_blank" class="btn btn-gradient btn-lg fw-bold">
              Baca Profil Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
            </a>
            <a href="#"
              class="btn btn-link text-dark fw-bold text-decoration-none d-flex align-items-center justify-content-center"
              data-bs-toggle="modal" data-bs-target="#videoProfileModal">
              <i class="fas fa-play-circle me-2 fs-4 text-danger"></i> Tonton Video Profil
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <div class="modal fade" id="videoProfileModal" tabindex="-1" aria-labelledby="videoProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-dark border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
        <div class="modal-header border-0 text-white pb-0">
          <h5 class="modal-title fw-bold" id="videoProfileModalLabel">Profil Jakarta</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3">
          <div class="ratio ratio-16x9 shadow-sm" style="border-radius: 10px; overflow: hidden;">
            <iframe id="videoIframe" src="https://www.youtube.com/embed/H8rP2V8zX0Q?enablejsapi=1"
              title="Video Profil Jakarta"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

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
              <p class="card-text">Pembangunan MRT fase 3 dimulai, menghubungkan kawasan barat dan timur Jakarta untuk
                mengurangi kemacetan...</p>
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
              <p class="card-text">Pemerintah Provinsi memberikan perpanjangan waktu bagi wajib pajak PBB hingga akhir
                bulan ini...</p>
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
              <p class="card-text">Pengakuan ini didasarkan pada inisiatif kota dalam pengelolaan limbah dan penggunaan
                energi terbarukan...</p>
              <a href="#" class="text-primary-custom fw-bold text-decoration-none">Baca Selengkapnya</a>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-5">
        <a href="berita.php" class="btn btn-outline-secondary-custom">Lihat Semua Berita <i
            class="fas fa-list-alt ms-2"></i></a>
      </div>
    </div>
  </section>

  <section class="quick-stats-section py-5 text-black" id="stats-section">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="mb-3 text-black fw-bold">Jakarta dalam Angka</h2>
        <p class="lead">Data dan Statistik Ibukota Berdasarkan Data Terbaru</p>
      </div>
      <div class="row g-4 text-center">
        <div class="col-md-3">
          <div class="stat-box p-4 rounded shadow-sm bg-white">
            <i class="fas fa-city fa-2x mb-3 text-primary"></i>
            <h3 class="display-5 fw-bold mb-0">
              <span class="counter" data-target="11.01">0</span><span> Juta</span>
            </h3>
            <p class="lead">Penduduk</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-box p-4 rounded shadow-sm bg-white">
            <i class="fas fa-bus fa-2x mb-3 text-danger"></i>
            <h3 class="display-5 fw-bold mb-0">
              <span class="counter" data-target="243">0</span>
            </h3>
            <p class="lead">Rute Layanan</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-box p-4 rounded shadow-sm bg-white">
            <i class="fas fa-tree fa-2x mb-3 text-success"></i>
            <h3 class="display-5 fw-bold mb-0">
              <span class="counter" data-target="3131">0</span>
            </h3>
            <p class="lead">Ruang Terbuka Hijau</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-box p-4 rounded shadow-sm bg-white">
            <i class="fas fa-file-invoice fa-2x mb-3 text-warning"></i>
            <h3 class="display-5 fw-bold mb-0">
              <span class="counter" data-target="245">0</span><span>+</span>
            </h3>
            <p class="lead">Layanan Online</p>
          </div>
        </div>
      </div>
      <div class="text-center mt-5">
        <a href="https://data.jakarta.go.id/" target="_blank" class="btn btn-outline-dark btn-lg fw-bold">Kunjungi
          Portal Satu Data Jakarta</a>
      </div>
    </div>
  </section>



  <a href="kreator.php" class="ogp-local-button" id="easterEggTrigger">
    <img src="assets/Logo1.png" alt="OGP Logo" style="height: 55px" />
    <div class="text-start ms-2">
      <span style="font-size: 0.7rem; opacity: 0.8;">Design By</span> <br />
      <span style="font-weight: 800; letter-spacing: 1px;">CoreJKT</span>
    </div>
  </a>

  <footer class="footer-corejkt py-4">
    <div class="container text-center">
      <p class="mb-0">
        &copy; 2025 CoreJKT - Portal Pemerintah Provinsi DKI Jakarta.
      </p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const navbar = document.querySelector(".navbar");

      function handleScroll() {
        // Jika scroll lebih dari 50px, tambah class solid
        if (window.scrollY > 50) {
          navbar.classList.add("navbar-scrolled");
        } else {
          navbar.classList.remove("navbar-scrolled");
        }
      }

      window.addEventListener("scroll", handleScroll);
      // Jalankan sekali saat load untuk cek posisi scroll
      handleScroll();
    });
  </script>

  <script>
    if (logoutBtn) {
      logoutBtn.addEventListener("click", () => {
        window.location.href = "index.php";
      });
    }

    <script>
      const panel = document.getElementById("accessPanel");

  document.getElementById("accessBtn").onclick = () => {
        panel.style.display = panel.style.display === "block" ? "none" : "block";
  };

      function toggleContrast() {
        document.body.classList.toggle("high-contrast");
  }

      function increaseFont() {
        document.body.style.fontSize = "18px";
  }

      function resetAccessibility() {
        document.body.classList.remove("high-contrast");
      document.body.style.fontSize = "";
  }

      function setSearch(text) {
    const input = document.querySelector('input[type="search"], input[name="search"]');
      if (input) {
        input.value = text;
      input.focus();
    }
  }
  </script>
  <script>
      const videoModal = document.getElementById('videoProfileModal');
      videoModal.addEventListener('hidden.bs.modal', function () {
        const iframe = videoModal.querySelector('iframe');
      const src = iframe.src;
      iframe.src = ''; // Menghapus src sejenak
      iframe.src = src; // Mengembalikan src (ini akan menghentikan video)
    });
  </script>
  <script>
document.addEventListener('DOMContentLoaded', function () {
    const myModalEl = document.getElementById('videoProfileModal');
    const videoIframe = document.getElementById('videoIframe');
    const originalSrc = videoIframe.src;

    // Pastikan video berhenti saat modal ditutup
    myModalEl.addEventListener('hidden.bs.modal', function () {
        videoIframe.src = "";
        videoIframe.src = originalSrc;
    });
});
  </script>
  <script>
document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.counter');
      const speed = 200; // Semakin besar angka, semakin lambat animasinya

    const startCounter = (el) => {
        const target = +el.getAttribute('data-target');
      const count = +el.innerText;

      // Hitung kecepatan penambahan
      const inc = target / speed;

      if (count < target) {
            // Cek apakah angka desimal (seperti 11.01) atau bulat
            if (target % 1 !== 0) {
        el.innerText = (count + inc).toFixed(2);
            } else {
        el.innerText = Math.ceil(count + inc);
            }
            setTimeout(() => startCounter(el), 1);
        } else {
        el.innerText = target;
        }
    };

      // Observer agar animasi jalan saat section terlihat di layar
      const observerOptions = {
        threshold: 0.5 // Animasi mulai saat 50% bagian terlihat
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const counterElement = entry.target.querySelector('.counter');
            // Jalankan counter hanya jika belum dianimasikan
            if (counterElement && counterElement.innerText === "0") {
              const allCounters = entry.target.querySelectorAll('.counter');
              allCounters.forEach(c => startCounter(c));
            }
          }
        });
    }, observerOptions);

      observer.observe(document.getElementById('stats-section'));
});
  </script>
  <div class="modal fade" id="maintenanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">

        <div class="modal-header">
          <h5 class="modal-title">
            🚧 Fitur Belum Tersedia
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body text-center">
          <i class="fas fa-tools fa-3x text-warning mb-3"></i>
          <p class="mb-0">
            Layanan <b>Kependudukan</b> sedang dalam tahap pengembangan.<br>
            Kami lagi ngebut biar cepat rilis 🚀
          </p>
        </div>

        <div class="modal-footer justify-content-center">
          <button class="btn btn-secondary" data-bs-dismiss="modal">
            Oke, paham
          </button>
        </div>

      </div>
    </div>
  </div>
  <script>
</body>

<div class="modal fade" id="videoProfileModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title text-white">Profil Provinsi DKI Jakarta</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="ratio ratio-16x9">
         <iframe id="videoIframe" 
        src="https://www.youtube.com/watch?v=JaPjQBua5Xw" 
        title="Video Profil Jakarta" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

</html >