<?php
session_start();
require "config.php";

// 1. CEK LOGIN
if (!isset($_SESSION["user"]["id"])) {
  header("Location: login.php");
  exit;
}

// 2. CEK KONEKSI DB
if (!$pdo) {
  die("Connection failed: Database not connected.");
}

$message = "";
$messageType = "success";

// 3. CREATE (INSERT LAPORAN)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $kategori = trim($_POST['kategori'] ?? "");
  $lokasi = trim($_POST['lokasi'] ?? "");
  $deskripsi = trim($_POST['deskripsi'] ?? "");

  if (empty($kategori) || empty($lokasi) || empty($deskripsi)) {
    $message = "Semua field harus diisi!";
    $messageType = "danger";
  } else {
    $foto_name = "";
    if (!empty($_FILES['foto']['name'])) {
      $allowed_ext = ['jpg', 'jpeg', 'png'];
      $file_ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
      $file_size = $_FILES['foto']['size'];

      if (!in_array($file_ext, $allowed_ext)) {
        $message = "Format file tidak didukung (JPG, JPEG, PNG).";
        $messageType = "danger";
      } elseif ($file_size > 5242880) {
        $message = "Ukuran file maksimal 5MB.";
        $messageType = "danger";
      } else {
        if (!file_exists("uploads")) {
          mkdir("uploads", 0777, true);
        }
        $foto_name = time() . "_" . uniqid() . "." . $file_ext;
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto_name)) {
          $message = "Gagal mengupload foto.";
          $messageType = "danger";
          $foto_name = "";
        }
      }
    }

    if ($messageType !== "danger") {
      try {
        $sql = "INSERT INTO laporan (id_user, kategori, lokasi, deskripsi, foto, status, tanggal)
                        VALUES (:id_user, :kategori, :lokasi, :deskripsi, :foto, 'pending', NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ":id_user" => $_SESSION["user"]["id"],
          ":kategori" => $kategori,
          ":lokasi" => $lokasi,
          ":deskripsi" => $deskripsi,
          ":foto" => $foto_name
        ]);
        header("Location: lapor.php?success=1");
        exit;
      } catch (PDOException $e) {
        $message = "Error database: " . $e->getMessage();
        $messageType = "danger";
      }
    }
  }
}

// 4. READ (AMBIL LAPORAN USER)
try {
  $sql = "SELECT * FROM laporan WHERE id_user = :id_user ORDER BY tanggal DESC LIMIT 5";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([":id_user" => $_SESSION["user"]["id"]]);
  $laporan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $laporan_list = [];
}

if (isset($_GET['success'])) {
  $message = "Laporan berhasil dikirim! Tim kami akan segera menindaklanjuti.";
  $messageType = "success";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Lapor & Kedaruratan - CoreJKT</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --blue-soft: #0d6efd;
      --blue-dark: #051025;
      --emergency: #dc3545;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: #f0f2f5;
      color: #333;
    }

    /* Layout & Header */
    .navbar {
      background: var(--blue-dark);
      border-bottom: 3px solid var(--blue-soft);
    }

    .page-header {
      background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-soft) 100%);
      color: white;
      padding: 80px 0;
      border-radius: 0 0 50px 50px;
    }

    /* Emergency Cards */
    .emergency-btn {
      background: white;
      border: none;
      border-radius: 20px;
      padding: 25px;
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      text-decoration: none !important;
      display: block;
      height: 100%;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .emergency-btn:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(220, 53, 69, 0.2);
    }

    .emergency-btn i {
      font-size: 3rem;
      margin-bottom: 15px;
      display: block;
    }

    /* Tracking Box */
    .tracking-banner {
      background: linear-gradient(90deg, #1a2a44 0%, var(--blue-dark) 100%);
      border-radius: 25px;
      color: white;
      padding: 40px;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Forms & Status */
    .card-custom {
      border: none;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .form-control,
    .form-select {
      background-color: #f8f9fa;
      border: 2px solid #f8f9fa;
      padding: 12px;
      border-radius: 12px;
    }

    .form-control:focus {
      background-color: #fff;
      border-color: var(--blue-soft);
      box-shadow: none;
    }

    .status-item {
      background: #fff;
      border-radius: 15px;
      margin-bottom: 15px;
      padding: 20px;
      transition: 0.3s;
      border-left: 5px solid #dee2e6;
    }

    .status-item:hover {
      transform: translateX(5px);
    }

    /* Image Preview Area */
    #imagePreviewContainer img {
      width: 100%;
      border-radius: 12px;
      margin-top: 10px;
      display: none;
      border: 2px solid #ddd;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
        <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
        <span class="fw-bold">CORE<span class="text-info">LAPOR</span></span>
      </a>
      <a href="dashboard.php" class="btn btn-info text-white rounded-pill px-4 btn-sm fw-bold">
        <i class="fas fa-home me-2"></i>Dashboard
      </a>
    </div>
  </nav>

  <header class="page-header text-center shadow">
    <div class="container">
      <h1 class="display-4 fw-bold mb-3">Pusat Bantuan & Laporan</h1>
      <p class="lead opacity-75">Kami siap melayani kedaruratan dan mendengar keluhan infrastruktur Anda.</p>
    </div>
  </header>

  <div class="container my-5">
    <div class="text-center mb-5">
      <h2 class="fw-bold text-danger">KONTAK DARURAT 24 JAM</h2>
      <div class="mx-auto bg-danger" style="width: 60px; height: 4px; border-radius: 2px;"></div>
    </div>

    <div class="row g-4 mb-5">
      <div class="col-lg-3 col-6">
        <a href="tel:119" class="emergency-btn text-center">
          <i class="fas fa-ambulance text-danger"></i>
          <h5 class="fw-bold text-dark">MEDIS 119</h5>
        </a>
      </div>
      <div class="col-lg-3 col-6">
        <a href="tel:113" class="emergency-btn text-center">
          <i class="fas fa-fire-extinguisher text-warning"></i>
          <h5 class="fw-bold text-dark">DAMKAR 113</h5>
        </a>
      </div>
      <div class="col-lg-3 col-6">
        <a href="tel:110" class="emergency-btn text-center">
          <i class="fas fa-shield-alt text-primary"></i>
          <h5 class="fw-bold text-dark">POLISI 110</h5>
        </a>
      </div>
      <div class="col-lg-3 col-6">
        <a href="tel:112" class="emergency-btn text-center" style="border: 2px solid #dc3545;">
          <i class="fas fa-phone-alt text-danger"></i>
          <h5 class="fw-bold text-danger">SIAGA 112</h5>
        </a>
      </div>
    </div>

    <div class="tracking-banner shadow-lg mb-5">
      <div class="row align-items-center text-center text-lg-start">
        <div class="col-lg-8">
          <h3 class="fw-bold"><i class="fas fa-satellite-dish me-2 text-info"></i> Live Unit Tracking</h3>
          <p class="mb-lg-0 opacity-75">Lacak armada ambulans atau pemadam kebakaran yang sedang menuju lokasi Anda.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
          <a href="live_tracking.php" class="btn btn-info btn-lg rounded-pill px-5 fw-bold text-white shadow">Buka
            Peta</a>
        </div>
      </div>
    </div>

    <div class="row g-5">
      <div class="col-lg-6">
        <div class="card card-custom p-4">
          <h4 class="fw-bold mb-4 text-primary"><i class="fas fa-pen-nib me-2"></i>Buat Laporan Warga</h4>

          <?php if (!empty($message)): ?>
            <div class="alert alert-<?= $messageType ?> alert-dismissible fade show">
              <?= htmlspecialchars($message) ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          <?php endif; ?>

          <form method="POST" enctype="multipart/form-data" id="reportForm">
            <div class="mb-3">
              <label class="form-label fw-bold">Kategori Masalah</label>
              <select class="form-select" name="kategori" required>
                <option value="">Pilih Kategori...</option>
                <option>Sampah & Kebersihan</option>
                <option>Jalan & Jembatan Rusak</option>
                <option>Lampu Jalan Mati</option>
                <option>Drainase & Banjir</option>
                <option>Lain-lain</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Titik Lokasi</label>
              <input type="text" class="form-control" name="lokasi" placeholder="Nama jalan, gedung, atau patokan..."
                required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Deskripsi Kejadian</label>
              <textarea class="form-control" name="deskripsi" rows="4"
                placeholder="Ceritakan detail masalah secara lengkap..." required></textarea>
            </div>

            <div class="mb-4">
              <label class="form-label fw-bold">Lampiran Foto</label>
              <input type="file" class="form-control" name="foto" id="fotoInput" accept="image/*">
              <div id="imagePreviewContainer">
                <img id="preview" src="#" alt="Pratinjau Foto">
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill fw-bold shadow">
              <i class="fas fa-paper-plane me-2"></i>Kirim Sekarang
            </button>
          </form>
        </div>
      </div>

      <div class="col-lg-6">
        <h4 class="fw-bold mb-4 text-primary"><i class="fas fa-stream me-2"></i>Pantau Laporan Anda</h4>

        <?php if (empty($laporan_list)): ?>
          <div class="text-center py-5">
            <i class="fas fa-folder-open fa-3x opacity-25 mb-3"></i>
            <p class="text-muted">Belum ada laporan yang Anda kirimkan.</p>
          </div>
        <?php else: ?>
          <div class="status-container">
            <?php foreach ($laporan_list as $l):
              $color = match ($l['status']) {
                'pending' => '#ffc107', 'diproses' => '#0dcaf0',
                'selesai' => '#198754', 'ditolak' => '#dc3545', default => '#6c757d'
              };
              $label = match ($l['status']) {
                'pending' => 'Menunggu', 'diproses' => 'Proses',
                'selesai' => 'Selesai', 'ditolak' => 'Ditolak', default => 'Status'
              };
              ?>
              <div class="status-item shadow-sm" style="border-left-color: <?= $color ?>;">
                <div class="d-flex justify-content-between">
                  <div>
                    <h6 class="fw-bold mb-1">LAPOR-<?= $l['id_laporan'] ?></h6>
                    <div class="small text-muted mb-1"><i class="fas fa-tag me-1"></i> <?= $l['kategori'] ?></div>
                    <div class="small text-muted"><i class="fas fa-calendar-alt me-1"></i>
                      <?= date('d M Y', strtotime($l['tanggal'])) ?></div>
                  </div>
                  <span class="badge" style="background-color: <?= $color ?>; height: fit-content;"><?= $label ?></span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="text-center mt-4">
            <a href="riwayat_laporan.php" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Lihat Semua
              Riwayat</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <footer class="py-5 text-white" style="background-color: var(--blue-dark);">
    <div class="container text-center">
      <img src="assets/Logo1.png" style="height: 45px; opacity: 0.8;" class="mb-3 grayscale">
      <p class="mb-0 opacity-50">&copy; 2026 CoreJKT Digital - Layanan Pengaduan Terpadu DKI Jakarta.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Pratinjau Foto Sebelum Upload
    const fotoInput = document.getElementById('fotoInput');
    const preview = document.getElementById('preview');

    fotoInput.onchange = evt => {
      const [file] = fotoInput.files;
      if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
      }
    }
  </script>
</body>

</html>