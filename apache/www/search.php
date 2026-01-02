<?php
session_start();

if (!isset($_SESSION["user"])) {
  header("Location: index.php");
  exit;
}

$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

// Data layanan (bisa dari database)
$layanan = [
    ['nama' => 'Kesehatan', 'url' => 'kesehatan.php', 'icon' => 'fa-heartbeat', 'desc' => 'Layanan kesehatan masyarakat Jakarta'],
    ['nama' => 'Pendidikan', 'url' => 'pendidikan.php', 'icon' => 'fa-graduation-cap', 'desc' => 'Informasi sekolah dan pendidikan'],
    ['nama' => 'Transportasi Publik', 'url' => 'transportasi.php', 'icon' => 'fa-bus-alt', 'desc' => 'Transjakarta, MRT, LRT'],
    ['nama' => 'Sosial', 'url' => 'sosial.php', 'icon' => 'fa-users', 'desc' => 'Program bantuan sosial'],
    ['nama' => 'Kependudukan', 'url' => 'kependudukan.php', 'icon' => 'fa-address-card', 'desc' => 'KTP, KK, Akta kelahiran'],
    ['nama' => 'Laporan Keuangan', 'url' => '#', 'icon' => 'fa-money-bill-wave', 'desc' => 'Transparansi keuangan daerah'],
    ['nama' => 'Jelajahi Jakarta', 'url' => 'jelajahjakarta.php', 'icon' => 'fa-torii-gate', 'desc' => 'Wisata dan budaya Jakarta'],
    ['nama' => 'CCTV', 'url' => 'cctv.php', 'icon' => 'fa-video', 'desc' => 'Pantau lalu lintas Jakarta'],
    ['nama' => 'E-Lapor', 'url' => 'lapor.php', 'icon' => 'fa-bullhorn', 'desc' => 'Laporkan masalah di Jakarta'],
];

// Filter hasil pencarian
$hasil = [];
if (!empty($searchQuery)) {
    foreach ($layanan as $item) {
        if (stripos($item['nama'], $searchQuery) !== false || 
            stripos($item['desc'], $searchQuery) !== false) {
            $hasil[] = $item;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hasil Pencarian - Portal CoreJKT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  
  <style>
    .search-header {
      background: linear-gradient(135deg, var(--blue-dark), var(--blue-soft));
      color: white;
      padding: 60px 0 40px;
    }
    .search-result-item {
      padding: 20px;
      border: 1px solid #e9ecef;
      border-radius: 8px;
      margin-bottom: 15px;
      transition: all 0.3s;
      background: white;
    }
    .search-result-item:hover {
      border-color: var(--blue-soft);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transform: translateY(-2px);
    }
    .search-result-icon {
      font-size: 2rem;
      color: var(--blue-soft);
      margin-right: 15px;
    }
    .highlight {
      background-color: #fff3cd;
      padding: 2px 4px;
      border-radius: 3px;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
        <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px" />
        <span class="brand-text">PORTAL PEMERINTAH PROVINSI DKI JAKARTA</span>
      </a>
      <div class="d-flex align-items-center">
        <a href="dashboard.php" class="btn btn-success-custom">
          <i class="fas fa-home"></i> Kembali
        </a>
      </div>
    </div>
  </nav>

  <div class="search-header">
    <div class="container">
      <h2 class="mb-4">
        <i class="fas fa-search me-2"></i>
        Hasil Pencarian
      </h2>
      
      <form action="search.php" method="GET">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="input-group input-group-lg">
              <span class="input-group-text bg-white">
                <i class="fas fa-search text-secondary"></i>
              </span>
              <input type="text" name="q" class="form-control" 
                     value="<?= htmlspecialchars($searchQuery) ?>" 
                     placeholder="Cari layanan..." required />
              <button type="submit" class="btn btn-light">Cari</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="container my-5">
    <?php if (empty($searchQuery)): ?>
      <div class="alert alert-info">
        <i class="fas fa-info-circle"></i> 
        Silakan masukkan kata kunci pencarian.
      </div>
    <?php elseif (empty($hasil)): ?>
      <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i> 
        Tidak ditemukan hasil untuk "<strong><?= htmlspecialchars($searchQuery) ?></strong>"
      </div>
      
      <h5 class="mt-4">Saran Pencarian:</h5>
      <ul>
        <li>Gunakan kata kunci yang lebih umum</li>
        <li>Coba kata kunci: kesehatan, transportasi, pendidikan, kependudukan</li>
      </ul>
    <?php else: ?>
      <h5 class="mb-4">
        Ditemukan <strong><?= count($hasil) ?></strong> hasil untuk 
        "<span class="text-primary"><?= htmlspecialchars($searchQuery) ?></span>"
      </h5>

      <div class="row">
        <div class="col-lg-8">
          <?php foreach ($hasil as $item): ?>
            <div class="search-result-item">
              <div class="d-flex align-items-start">
                <i class="fas <?= $item['icon'] ?> search-result-icon"></i>
                <div class="flex-grow-1">
                  <h5>
                    <a href="<?= $item['url'] ?>" class="text-decoration-none text-dark">
                      <?= highlightText($item['nama'], $searchQuery) ?>
                    </a>
                  </h5>
                  <p class="text-muted mb-2">
                    <?= highlightText($item['desc'], $searchQuery) ?>
                  </p>
                  <a href="<?= $item['url'] ?>" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-arrow-right"></i> Buka Layanan
                  </a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="col-lg-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h6 class="fw-bold mb-3">
                <i class="fas fa-fire text-danger"></i> 
                Layanan Populer
              </h6>
              <ul class="list-unstyled">
                <li class="mb-2">
                  <a href="kesehatan.php" class="text-decoration-none">
                    <i class="fas fa-heartbeat text-primary"></i> Kesehatan
                  </a>
                </li>
                <li class="mb-2">
                  <a href="transportasi.php" class="text-decoration-none">
                    <i class="fas fa-bus-alt text-primary"></i> Transportasi
                  </a>
                </li>
                <li class="mb-2">
                  <a href="lapor.php" class="text-decoration-none">
                    <i class="fas fa-bullhorn text-primary"></i> E-Lapor
                  </a>
                </li>
                <li class="mb-2">
                  <a href="kependudukan.php" class="text-decoration-none">
                    <i class="fas fa-address-card text-primary"></i> Kependudukan
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <footer class="footer-corejkt py-4">
    <div class="container text-center">
      <p class="mb-0">&copy; 2025 CoreJKT - Portal Pemerintah Provinsi DKI Jakarta.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Helper function untuk highlight kata kunci
function highlightText($text, $keyword) {
    if (empty($keyword)) return htmlspecialchars($text);
    
    $highlighted = preg_replace(
        '/(' . preg_quote($keyword, '/') . ')/i',
        '<span class="highlight">$1</span>',
        htmlspecialchars($text)
    );
    
    return $highlighted;
}
?>