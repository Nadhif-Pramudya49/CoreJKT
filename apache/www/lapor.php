<?php
session_start();
require "config.php"; // ini menyediakan $pdo (PDO connection)

// Cek koneksi PDO
if (!$pdo) {
    die("Connection failed: Database not connected.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Ambil data form
    $kategori   = $_POST['kategori']   ?? "";
    $lokasi     = $_POST['lokasi']     ?? "";
    $deskripsi  = $_POST['deskripsi']  ?? "";

    // Upload foto
    $foto_name = "";
    if (!empty($_FILES['foto']['name'])) {
        $foto_name = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $foto_name);
    }

     // INSERT ke database
    try {
        $sql = "INSERT INTO laporan (id_user, kategori, lokasi, deskripsi, foto, status) 
                VALUES (:id_user, :kategori, :lokasi, :deskripsi, :foto, 'pending')";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":id_user"   => $_SESSION["user"]["id_user"],
            ":kategori"  => $kategori,
            ":lokasi"    => $lokasi,
            ":deskripsi" => $deskripsi,
            ":foto"      => $foto_name
        ]);

        $message = "Laporan berhasil dibuat!";
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Lapor & Kedaruratan - CoreJKT</title>

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
    <nav
      class="navbar navbar-expand-lg navbar-dark shadow-sm py-3"
      style="background-color: var(--blue-dark)"
    >
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
          <img
            src="assets/Logo1.png"
            alt="Logo CoreJKT"
            class="me-2"
            style="height: 40px"
          />
          <span class="brand-text">E-LAPOR & KEDARURATAN</span>
        </a>
        <div class="d-flex align-items-center">
          <a href="dashboard.php" class="btn btn-success-custom"
            ><i class="fas fa-home"></i> Kembali ke Dashboard</a
          >
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

      <div class="row g-4 justify-content-center">
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
          <a
            href="tel:123"
            class="emergency-contact shadow-sm"
            style="border-color: #ffc107; color: #ffc107"
          >
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
        <a href="#" class="btn btn-lg btn-danger"
          ><i class="fas fa-map-marked-alt"></i> Lihat Peta Tracking</a
        >
      </div>
    </div>

    <hr class="my-5" />

    <section class="container mb-5">
      <h2
        class="text-center mb-5"
        style="color: var(--blue-dark); font-weight: 700"
      >
        Pelaporan Non-Darurat (Laporan Warga)
      </h2>
<?php if (!empty($message)): ?>
    <div class="alert alert-success"><?= $message ?></div>
<?php endif; ?>

      <div class="row g-4 justify-content-center">
        <div class="col-lg-6">
          <h4 style="color: var(--blue-soft)">Buat Laporan Baru</h4>
          <div class="card p-4 shadow-sm"action="lapor_process.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="category" class="form-label">Kategori Laporan</label>
           <select class="form-select" id="category" name="kategori">
                <option selected>Pilih Kategori Masalah</option>
                <option>Sampah/Kebersihan Lingkungan</option>
                <option>Jalan Rusak/Berlubang</option>
                <option>Lampu Jalan Mati</option>
                <option>Fasilitas Umum Rusak (Taman, Trotoar)</option>
                <option>Lain-lain</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="location" class="form-label">Lokasi Kejadian</label>
              <input
                type="text"
                class="form-control"
                id="location"
                name="lokasi"
                placeholder="Contoh: Jl. Sudirman No. 12, dekat JPO"
              />
            </div>
            <div class="mb-3">
              <label for="description" class="form-label"
                >Deskripsi Masalah</label
              >
              <textarea
                class="form-control"
                id="description"
                name="deskripsi"
                rows="3"
                placeholder="Jelaskan detail masalah yang terjadi..."
              ></textarea>
            </div>
            <div class="mb-3">
              <label for="photo" class="form-label" 
                >Unggah Foto (Opsional)</label
              >
              <input type="file" class="form-control" id="photo" name="foto" />
            </div>
         <button type="submit" class="btn btn-lg mt-3" style="background-color: var(--blue-soft); color: white">
  Kirim Laporan
</button>
          </div>
        </div>

        <div class="col-lg-6">
          <h4 style="color: var(--blue-soft)">Status Laporan Anda</h4>
          <ul class="list-group shadow-sm">
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
            >
              Laporan #20250901 - Sampah Menumpuk
              <span class="badge bg-warning text-dark">Diproses</span>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
            >
              Laporan #20250820 - Lampu Mati di Jl. Veteran
              <span class="badge bg-success">Selesai</span>
            </li>
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
            >
              Laporan #20250705 - Jalan Berlubang
              <span class="badge bg-info text-dark">Diterima</span>
            </li>
            <li class="list-group-item text-center">
              <a href="#" class="text-secondary">Lihat Semua Riwayat Laporan</a>
            </li>
          </ul>
        </div>
      </div>
    </section>

    <footer
      class="text-white py-4"
      style="background-color: #051025 !important"
    >
      <div class="container text-center">
        <p>&copy; 2024 CoreJKT - E-Lapor & Kedaruratan DKI Jakarta.</p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
