<?php
session_start();
require "config.php";

// CEK LOGIN

if (!isset($_SESSION["user"]["id"])) {
  header("Location: login.php");
  exit;
}

// CEK KONEKSI DB

if (!$pdo) {
  die("Connection failed: Database not connected.");
}

$message = "";
$messageType = "success";

// CREATE (INSERT LAPORAN)

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $kategori = trim($_POST['kategori'] ?? "");
  $lokasi = trim($_POST['lokasi'] ?? "");
  $deskripsi = trim($_POST['deskripsi'] ?? "");

  if (empty($kategori) || empty($lokasi) || empty($deskripsi)) {
    $message = "Semua field harus diisi!";
    $messageType = "danger";
  } else {

    // ---------- Upload Foto ----------
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

    // ---------- INSERT KE DB ----------
    if ($messageType !== "danger") {
      try {
        $sql = "INSERT INTO laporan 
                        (id_user, kategori, lokasi, deskripsi, foto, status, tanggal)
                        VALUES 
                        (:id_user, :kategori, :lokasi, :deskripsi, :foto, 'pending', NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
          ":id_user" => $_SESSION["user"]["id"], // 🔥 FIX UTAMA
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

// ======================
// READ (AMBIL LAPORAN USER)
// ======================
try {
  $sql = "SELECT * FROM laporan 
            WHERE id_user = :id_user 
            ORDER BY tanggal DESC";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ":id_user" => $_SESSION["user"]["id"] // 🔥 FIX UTAMA
  ]);

  $laporan_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  $laporan_list = [];
}

// ======================
// PESAN REDIRECT
// ======================
if (isset($_GET['success'])) {
  $message = "Laporan berhasil dikirim! Tim kami akan segera menindaklanjuti.";
  $messageType = "success";
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Lapor & Kedaruratan - CoreJKT</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/style.css" />

  <style>
    .page-header {
      background-color: var(--blue-soft);
      color: white;
      padding: 40px 0;
    }

    .report-card {
      transition: all 0.3s ease;
      cursor: pointer;
      border-left: 5px solid var(--blue-dark);
      min-height: 180px;
    }

    .report-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .report-icon {
      font-size: 2.5rem;
      color: var(--blue-soft);
      margin-bottom: 10px;
    }



    .emergency-contact {

      background-color: #ffffff;
      border: 1px solid #dee2e6;
      color: var(--text-color-dark);
      padding: 20px 15px;
      border-radius: 8px;
      text-align: center;
      transition: all 0.2s;
      display: block;
      text-decoration: none;
      min-height: 180px;
    }

    .emergency-contact:hover {
      background-color: #f0f0f0;
      border-color: var(--blue-soft);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .emergency-contact h4 {
      font-weight: bold;
      color: var(--blue-dark);
      font-size: 1.2rem;
      margin-top: 10px;
    }

    .emergency-contact .contact-icon {
      font-size: 2.5rem;
      color: #dc3545;
      margin-bottom: 5px;
    }

    .icon-police .contact-icon {
      color: var(--blue-soft);
    }

    .icon-pln .contact-icon {
      color: #ffc107;
    }

    .emergency-contact p {
      font-size: 0.9rem;
      color: #6c757d;
    }

    .emergency-contact p strong {
      color: #343a40;
    }




    .tracking-box {
      background-color: var(--blue-dark);
      color: white;
      padding: 30px;
      border-radius: 10px;
      text-align: center;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark)">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
        <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px" />
        <span class="brand-text">E-LAPOR & KEDARURATAN</span>
      </a>
      <div class="d-flex align-items-center">
        <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Kembali ke Dashboard</a>
      </div>
    </div>
  </nav>

  <section class="page-header">
    <div class="container text-center">
      <i class="fas fa-bullhorn fa-3x mb-3"></i>
      <h1 class="display-5 fw-bold mb-0">
        Pusat Pelaporan dan Panggilan Darurat
      </h1>
      <p class="lead mt-2">
        Laporkan masalah non-darurat dan akses kontak kedaruratan segera.
      </p>
    </div>
  </section>

  <div class="container my-5">
    <h2 class="text-center mb-4 text-danger" style="font-weight: 700">
      Akses Cepat Kedaruratan (Telepon 112)
    </h2>
    <p class="text-center text-secondary mb-4">
      Dalam kondisi mendesak, segera hubungi nomor 112 (Layanan Tunggal
      Panggilan Darurat) atau kontak spesifik di bawah ini.
    </p>

    <div class="row g-4 justify-content-center mb-5">
      <div class="col-lg-3 col-md-6">
        <a href="tel:119" class="emergency-contact shadow-sm">
          <i class="fas fa-ambulance contact-icon"></i>
          <h4>Ambulans & Medis</h4>
          <p class="mb-0">Nomor Tunggal: **119**</p>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="tel:113" class="emergency-contact shadow-sm">
          <i class="fas fa-fire contact-icon"></i>
          <h4>Pemadam Kebakaran</h4>
          <p class="mb-0">Nomor Alternatif: **113**</p>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="tel:110" class="emergency-contact shadow-sm">
          <i class="fas fa-user-shield contact-icon"></i>
          <h4>Kepolisian</h4>
          <p class="mb-0">Nomor Alternatif: **110**</p>
        </a>
      </div>

      <div class="col-lg-3 col-md-6">
        <a href="tel:123" class="emergency-contact shadow-sm" style="border-color: #ffc107; color: #ffc107">
          <i class="fas fa-bolt contact-icon" style="color: #ffc107"></i>
          <h4 style="color: #ffc107">Gangguan Listrik</h4>
          <p class="mb-0">Kontak PLN: **123**</p>
        </a>
      </div>
    </div>

    <div class="tracking-box mt-5 shadow">
      <h3 class="fw-bold mb-3">
        <i class="fas fa-location-arrow me-2"></i> Live Tracking Kendaraan
        Darurat
      </h3>
      <p class="lead">
        Lacak posisi real-time Ambulans, Pemadam, dan Patroli Polisi yang
        merespons laporan Anda.
      </p>
      <a href="#" class="btn btn-lg btn-danger"><i class="fas fa-map-marked-alt"></i> Lihat Peta Tracking</a>
    </div>
  </div>

  <hr class="my-5" />

  <section class="container mb-5">
    <h2 class="text-center mb-5" style="color: var(--blue-dark); font-weight: 700">
      Pelaporan Non-Darurat (Laporan Warga)
    </h2>
    <?php if (!empty($message)): ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <div class="row g-4 justify-content-center">

      <!-- KOLOM KIRI: BUAT LAPORAN -->
      <div class="col-lg-6">
        <h4 style="color: var(--blue-soft)" class="mb-3">Buat Laporan Baru</h4>

        <?php if (!empty($message)): ?>
          <div class="alert alert-<?= $messageType ?> alert-dismissible fade show">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
        <?php endif; ?>

        <form class="card p-4 shadow-sm" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Kategori Laporan</label>
            <select class="form-select" name="kategori" required>
              <option value="">Pilih Kategori Masalah</option>
              <option>Sampah/Kebersihan Lingkungan</option>
              <option>Jalan Rusak/Berlubang</option>
              <option>Lampu Jalan Mati</option>
              <option>Fasilitas Umum Rusak (Taman, Trotoar)</option>
              <option>Lain-lain</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Lokasi Kejadian</label>
            <input type="text" class="form-control" name="lokasi" placeholder="Contoh: Jl. Sudirman No. 12, dekat JPO"
              required>
          </div>

          <div class="mb-3">
            <label class="form-label">Deskripsi Masalah</label>
            <textarea class="form-control" name="deskripsi" rows="4"
              placeholder="Jelaskan detail masalah yang terjadi..." required></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Unggah Foto (Opsional)</label>
            <input type="file" class="form-control" name="foto" accept="image/*">
            <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 5MB</small>
          </div>

          <button type="submit" class="btn btn-lg w-100" style="background-color: var(--blue-soft); color: white">
            <i class="fas fa-paper-plane"></i> Kirim Laporan
          </button>
        </form>
      </div>

      <!-- KOLOM KANAN: STATUS LAPORAN -->
      <div class="col-lg-6">
        <h4 style="color: var(--blue-soft)" class="mb-3">Status Laporan Anda</h4>

        <?php if (empty($laporan_list)): ?>
          <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Anda belum memiliki laporan.
          </div>
        <?php else: ?>
          <div class="card shadow-sm">
            <ul class="list-group list-group-flush">
              <?php foreach ($laporan_list as $laporan): ?>
                <?php
                $badgeClass = match ($laporan['status']) {
                  'pending' => 'warning text-dark',
                  'diproses' => 'info text-dark',
                  'selesai' => 'success',
                  'ditolak' => 'danger',
                  default => 'secondary'
                };

                $statusText = match ($laporan['status']) {
                  'pending' => 'Menunggu',
                  'diproses' => 'Diproses',
                  'selesai' => 'Selesai',
                  'ditolak' => 'Ditolak',
                  default => ucfirst($laporan['status'])
                };
                ?>
                <li class="list-group-item">
                  <div class="d-flex justify-content-between align-items-start">
                    <div class="me-2">
                      <div class="fw-bold">
                        Laporan #<?= $laporan['id_laporan'] ?>
                      </div>
                      <div class="text-muted small">
                        <i class="fas fa-tag"></i> <?= htmlspecialchars($laporan['kategori']) ?>
                      </div>
                      <div class="text-muted small">
                        <i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars(substr($laporan['lokasi'], 0, 40)) ?>...
                      </div>
                      <div class="text-muted small">
                        <i class="fas fa-clock"></i> <?= date('d M Y', strtotime($laporan['tanggal'])) ?>
                      </div>
                    </div>
                    <span class="badge bg-<?= $badgeClass ?>">
                      <?= $statusText ?>
                    </span>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>

            <div class="card-body text-center">
              <a href="riwayat_laporan.php" class="text-decoration-none">
                <i class="fas fa-history"></i> Lihat Semua Riwayat Laporan
              </a>
            </div>
          </div>
        <?php endif; ?>
      </div>

    </div>

    </div>
  </section>

  <footer class="text-white py-4" style="background-color: #051025 !important">
    <div class="container text-center">
      <p>&copy; 2025 CoreJKT - E-Lapor & Kedaruratan DKI Jakarta.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>