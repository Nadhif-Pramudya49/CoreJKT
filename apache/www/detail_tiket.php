<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['kode'])) {
    header("Location: login.php");
    exit();
}

$kode_booking = $_GET['kode'];
$user_id = $_SESSION['user_id'];

// Ambil detail pemesanan
$stmt = $pdo->prepare("
    SELECT 
        pt.*,
        j.waktu_keberangkatan,
        r.nama_rute, r.stasiun_awal, r.stasiun_akhir, r.harga,
        jt.nama_transportasi, jt.icon
    FROM pemesanan_tiket pt
    JOIN jadwal j ON pt.jadwal_id = j.id
    JOIN rute r ON j.rute_id = r.id
    JOIN jenis_transportasi jt ON r.jenis_transportasi_id = jt.id
    WHERE pt.kode_booking = ? AND pt.user_id = ?
");
$stmt->execute([$kode_booking, $user_id]);
$tiket = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tiket) {
    die("Tiket tidak ditemukan!");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket - <?php echo $kode_booking; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #1e3a8a;
        }
        .ticket-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .ticket-header {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-soft) 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .ticket-body {
            padding: 30px;
        }
        .qr-code {
            width: 150px;
            height: 150px;
            background: #f0f0f0;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px dashed #ccc;
        }
        .status-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
        }
        .status-lunas {
            background: #28a745;
            color: white;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            .ticket-container, .ticket-container * {
                visibility: visible;
            }
            .ticket-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body style="background-color: #f5f5f5;">
    <div class="container">
        <div class="ticket-container">
            <div class="ticket-header position-relative">
                <span class="status-badge status-<?php echo $tiket['status_pembayaran']; ?>">
                    <?php echo strtoupper($tiket['status_pembayaran']); ?>
                </span>
                <i class="fas <?php echo $tiket['icon']; ?> fa-3x mb-3"></i>
                <h2>E-TICKET</h2>
                <h4><?php echo htmlspecialchars($tiket['nama_transportasi']); ?></h4>
            </div>
            
            <div class="ticket-body">
                <div class="text-center mb-4">
                    <h3 class="text-primary mb-0"><?php echo $tiket['kode_booking']; ?></h3>
                    <small class="text-muted">Kode Booking</small>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <small class="text-muted d-block">Rute</small>
                            <h5><?php echo htmlspecialchars($tiket['stasiun_awal']); ?></h5>
                            <div class="my-2">
                                <i class="fas fa-arrow-down text-primary"></i>
                            </div>
                            <h5><?php echo htmlspecialchars($tiket['stasiun_akhir']); ?></h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <small class="text-muted d-block">Tanggal & Waktu</small>
                            <h5>
                                <?php 
                                $tanggal = new DateTime($tiket['tanggal_perjalanan']);
                                echo $tanggal->format('d M Y'); 
                                ?>
                            </h5>
                            <h5 class="text-primary">
                                <i class="fas fa-clock"></i>
                                <?php echo substr($tiket['waktu_keberangkatan'], 0, 5); ?>
                            </h5>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <small class="text-muted d-block">Nama Penumpang</small>
                            <strong><?php echo htmlspecialchars($tiket['nama_penumpang']); ?></strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">No. Telepon</small>
                            <strong><?php echo htmlspecialchars($tiket['no_telepon']); ?></strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <small class="text-muted d-block">Jumlah Tiket</small>
                            <strong><?php echo $tiket['jumlah_tiket']; ?> Tiket</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Metode Pembayaran</small>
                            <strong><?php echo htmlspecialchars($tiket['metode_pembayaran']); ?></strong>
                        </div>
                    </div>
                </div>
                
                <div class="qr-code">
                    <i class="fas fa-qrcode fa-5x text-secondary"></i>
                </div>
                
                <div class="alert alert-info text-center">
                    <strong>Total Pembayaran</strong><br>
                    <h3 class="mb-0 text-primary">Rp <?php echo number_format($tiket['total_harga'], 0, ',', '.'); ?></h3>
                </div>
                
                <div class="text-center no-print mt-4">
                    <button class="btn btn-primary btn-lg me-2" onclick="window.print()">
                        <i class="fas fa-print"></i> Cetak Tiket
                    </button>
                    <a href="history_tiket.php" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-history"></i> Lihat History
                    </a>
                </div>
                
                <div class="mt-4 text-center">
                    <small class="text-muted">
                        Dipesan pada: <?php echo date('d M Y H:i', strtotime($tiket['created_at'])); ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>