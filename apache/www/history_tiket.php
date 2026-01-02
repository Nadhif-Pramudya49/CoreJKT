<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil history pemesanan
$stmt = $pdo->prepare("
    SELECT 
        pt.*,
        j.waktu_keberangkatan,
        r.nama_rute, r.stasiun_awal, r.stasiun_akhir,
        jt.nama_transportasi, jt.icon
    FROM pemesanan_tiket pt
    JOIN jadwal j ON pt.jadwal_id = j.id
    JOIN rute r ON j.rute_id = r.id
    JOIN jenis_transportasi jt ON r.jenis_transportasi_id = jt.id
    WHERE pt.user_id = ?
    ORDER BY pt.created_at DESC
");
$stmt->execute([$user_id]);
$history = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pemesanan - CoreJKT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #1e3a8a;
        }
        .history-card {
            transition: all 0.3s;
            border-left: 5px solid var(--blue-soft);
        }
        .history-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-lunas {
            background: #28a745;
            color: white;
        }
        .status-pending {
            background: #ffc107;
            color: #000;
        }
        .status-batal {
            background: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">HISTORY PEMESANAN</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="eticket.php" class="btn btn-success me-2">
                    <i class="fas fa-plus"></i> Pesan Tiket
                </a>
                <a href="transportasi.php" class="btn btn-outline-light">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="mb-4 text-center" style="color: var(--blue-dark);">
            <i class="fas fa-history"></i> Riwayat Pemesanan Tiket
        </h2>

        <?php if (count($history) > 0): ?>
            <div class="row g-4">
                <?php foreach ($history as $item): ?>
                <div class="col-md-6">
                    <div class="card history-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title mb-1">
                                        <i class="fas <?php echo $item['icon']; ?>"></i>
                                        <?php echo htmlspecialchars($item['nama_transportasi']); ?>
                                    </h5>
                                    <small class="text-muted">
                                        <?php echo date('d M Y H:i', strtotime($item['created_at'])); ?>
                                    </small>
                                </div>
                                <span class="status-badge status-<?php echo $item['status_pembayaran']; ?>">
                                    <?php echo strtoupper($item['status_pembayaran']); ?>
                                </span>
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-circle text-success me-2" style="font-size: 10px;"></i>
                                    <strong><?php echo htmlspecialchars($item['stasiun_awal']); ?></strong>
                                </div>
                                <div class="ms-3">
                                    <i class="fas fa-arrow-down text-primary"></i>
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                    <i class="fas fa-circle text-danger me-2" style="font-size: 10px;"></i>
                                    <strong><?php echo htmlspecialchars($item['stasiun_akhir']); ?></strong>
                                </div>
                            </div>
                            
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <small class="text-muted d-block">Tanggal Perjalanan</small>
                                    <strong>
                                        <?php 
                                        $tanggal = new DateTime($item['tanggal_perjalanan']);
                                        echo $tanggal->format('d M Y'); 
                                        ?>
                                    </strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Waktu</small>
                                    <strong>
                                        <i class="fas fa-clock"></i>
                                        <?php echo substr($item['waktu_keberangkatan'], 0, 5); ?>
                                    </strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Kode Booking</small>
                                    <strong><?php echo $item['kode_booking']; ?></strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Jumlah Tiket</small>
                                    <strong><?php echo $item['jumlah_tiket']; ?> Tiket</strong>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block">Total Pembayaran</small>
                                    <h5 class="text-primary mb-0">
                                        Rp <?php echo number_format($item['total_harga'], 0, ',', '.'); ?>
                                    </h5>
                                </div>
                                <div>
                                    <a href="detail_tiket.php?kode=<?php echo $item['kode_booking']; ?>" 
                                       class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Lihat Detail
                                    </a>
                                    <?php if ($item['status_pembayaran'] !== 'batal'): ?>
                                    <button class="btn btn-sm btn-outline-danger" 
                                            onclick="batalkanPesanan(<?php echo $item['id']; ?>)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-ticket-alt fa-5x text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Riwayat Pemesanan</h4>
                <p class="text-muted">Mulai pesan tiket transportasi Anda sekarang!</p>
                <a href="eticket.php" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-plus"></i> Pesan Tiket Sekarang
                </a>
            </div>
        <?php endif; ?>
    </div>

    <footer class="text-white py-4 mt-5" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 CoreJKT - Layanan Transportasi Publik DKI Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function batalkanPesanan(id) {
            if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
                fetch('batal_pesanan.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pesanan berhasil dibatalkan');
                        location.reload();
                    } else {
                        alert('Gagal membatalkan pesanan');
                    }
                });
            }
        }
    </script>
</body>
</html>