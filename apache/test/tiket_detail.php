<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: eticket.php");
    exit;
}

$tiket_id = $_GET['id'];

// Ambil data tiket lengkap
$stmt = $pdo->prepare("SELECT t.*, r.nama_rute, r.stasiun_awal, r.stasiun_akhir, r.durasi_menit,
                       jt.nama_transportasi, jt.icon,
                       p.kode_pembayaran, p.metode_pembayaran, p.nama_metode, p.tanggal_bayar
                       FROM tiket t
                       JOIN rute r ON t.rute_id = r.id
                       JOIN jenis_transportasi jt ON r.jenis_transportasi_id = jt.id
                       LEFT JOIN pembayaran p ON t.id = p.tiket_id
                       WHERE t.id = ? AND t.user_id = ?");
$stmt->execute([$tiket_id, $_SESSION['user_id']]);
$tiket = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tiket) {
    $_SESSION['error'] = "Tiket tidak ditemukan";
    header("Location: eticket.php");
    exit;
}

// Ambil riwayat penggunaan
$stmt = $pdo->prepare("SELECT * FROM riwayat_tiket WHERE tiket_id = ? ORDER BY waktu_scan DESC");
$stmt->execute([$tiket_id]);
$riwayat = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Tiket - CoreJKT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    
    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #1e88e5;
        }
        .ticket-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .ticket-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .ticket-header {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-soft) 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .ticket-body {
            padding: 30px;
            background: white;
        }
        .qr-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
        }
        .qr-code {
            width: 250px;
            height: 250px;
            margin: 0 auto;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid var(--blue-soft);
            border-radius: 10px;
        }
        .divider {
            border-top: 2px dashed #ddd;
            margin: 20px 0;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-label {
            color: #666;
            font-size: 0.9rem;
        }
        .info-value {
            font-weight: 600;
            text-align: right;
        }
        @media print {
            .no-print {
                display: none;
            }
            .ticket-card {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3 no-print" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" style="height: 40px;">
            </a>
            <div class="d-flex">
                <a href="eticket.php#tiket" class="btn btn-outline-light me-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn btn-light">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show no-print">
            <i class="fas fa-check-circle"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="ticket-container">
            <div class="ticket-card">
                <!-- Header Tiket -->
                <div class="ticket-header">
                    <i class="fas <?= htmlspecialchars($tiket['icon']) ?> fa-3x mb-3"></i>
                    <h3><?= htmlspecialchars($tiket['nama_transportasi']) ?></h3>
                    <h5><?= htmlspecialchars($tiket['nama_rute']) ?></h5>
                    <div class="mt-3">
                        <span class="badge 
                            <?php 
                            echo match($tiket['status_tiket']) {
                                'paid' => 'bg-success',
                                'pending' => 'bg-warning text-dark',
                                'used' => 'bg-secondary',
                                'expired' => 'bg-danger',
                                'cancelled' => 'bg-dark',
                                default => 'bg-info'
                            };
                            ?> fs-6">
                            <?= strtoupper($tiket['status_tiket']) ?>
                        </span>
                    </div>
                </div>

                <div class="ticket-body">
                    <!-- Kode Tiket -->
                    <div class="text-center mb-4">
                        <h6 class="text-muted mb-2">KODE TIKET</h6>
                        <h2 class="text-primary"><?= htmlspecialchars($tiket['kode_tiket']) ?></h2>
                    </div>

                    <?php if ($tiket['status_tiket'] == 'paid' && $tiket['qr_code']): ?>
                    <!-- QR Code -->
                    <div class="qr-container">
                        <div class="qr-code">
                            <div>
                                <i class="fas fa-qrcode fa-10x text-secondary"></i>
                                <p class="small text-muted mt-2">QR Code untuk Validasi</p>
                            </div>
                        </div>
                        <p class="text-muted small mt-3">
                            <i class="fas fa-info-circle"></i> Tunjukkan QR Code ini kepada petugas saat naik
                        </p>
                    </div>
                    <?php endif; ?>

                    <div class="divider"></div>

                    <!-- Informasi Perjalanan -->
                    <h6 class="mb-3"><i class="fas fa-route"></i> Informasi Perjalanan</h6>
                    
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-map-marker-alt text-success"></i> Keberangkatan</span>
                        <span class="info-value"><?= htmlspecialchars($tiket['stasiun_awal']) ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-map-marker-alt text-danger"></i> Tujuan</span>
                        <span class="info-value"><?= htmlspecialchars($tiket['stasiun_akhir']) ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-calendar"></i> Tanggal</span>
                        <span class="info-value"><?= date('d F Y', strtotime($tiket['tanggal_perjalanan'])) ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-clock"></i> Waktu</span>
                        <span class="info-value"><?= date('H:i', strtotime($tiket['waktu_keberangkatan'])) ?> WIB</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-hourglass-half"></i> Estimasi Durasi</span>
                        <span class="info-value">~<?= $tiket['durasi_menit'] ?> menit</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label"><i class="fas fa-users"></i> Jumlah Penumpang</span>
                        <span class="info-value"><?= $tiket['jumlah_penumpang'] ?> orang</span>
                    </div>

                    <div class="divider"></div>

                    <!-- Informasi Pembayaran -->
                    <h6 class="mb-3"><i class="fas fa-credit-card"></i> Informasi Pembayaran</h6>
                    
                    <?php if ($tiket['status_tiket'] == 'paid'): ?>
                    <div class="info-row">
                        <span class="info-label">Metode Pembayaran</span>
                        <span class="info-value"><?= htmlspecialchars($tiket['nama_metode'] ?? '-') ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Tanggal Pembayaran</span>
                        <span class="info-value"><?= $tiket['tanggal_bayar'] ? date('d/m/Y H:i', strtotime($tiket['tanggal_bayar'])) : '-' ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Kode Pembayaran</span>
                        <span class="info-value"><?= htmlspecialchars($tiket['kode_pembayaran'] ?? '-') ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="info-row">
                        <span class="info-label"><strong>Total Harga</strong></span>
                        <span class="info-value"><strong class="text-primary">Rp <?= number_format($tiket['total_harga'], 0, ',', '.') ?></strong></span>
                    </div>

                    <?php if ($tiket['status_tiket'] == 'paid'): ?>
                    <div class="divider"></div>
                    
                    <!-- Tombol Aksi -->
                    <div class="d-grid gap-2 no-print">
                        <button class="btn btn-primary" onclick="downloadTicket()">
                            <i class="fas fa-download"></i> Download Tiket
                        </button>
                        <button class="btn btn-outline-danger" onclick="confirmCancel()">
                            <i class="fas fa-times-circle"></i> Batalkan Tiket
                        </button>
                    </div>
                    <?php elseif ($tiket['status_tiket'] == 'pending'): ?>
                    <div class="divider"></div>
                    <div class="d-grid no-print">
                        <a href="pembayaran.php?tiket_id=<?= $tiket_id ?>" class="btn btn-warning btn-lg">
                            <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($riwayat)): ?>
                    <div class="divider"></div>
                    
                    <!-- Riwayat Penggunaan -->
                    <h6 class="mb-3"><i class="fas fa-history"></i> Riwayat Penggunaan</h6>
                    <?php foreach ($riwayat as $r): ?>
                    <div class="alert alert-secondary small">
                        <strong><?= date('d/m/Y H:i', strtotime($r['waktu_scan'])) ?></strong><br>
                        Lokasi: <?= htmlspecialchars($r['lokasi_scan']) ?><br>
                        <?= htmlspecialchars($r['keterangan']) ?>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-center mt-4 text-muted small">
                <p>Tiket ini sah dan dilindungi sistem. Pemalsuan tiket adalah tindakan ilegal.</p>
                <p>Dibuat: <?= date('d/m/Y H:i', strtotime($tiket['created_at'])) ?></p>
            </div>
        </div>
    </div>

    <footer class="text-white py-4 no-print" style="background-color: #051025;">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 CoreJKT - E-Ticketing Jakarta</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function downloadTicket() {
            // Implementasi download sebagai PDF atau gambar
            alert('Fitur download akan segera tersedia. Saat ini Anda bisa menggunakan fungsi Print.');
            window.print();
        }
        
        function confirmCancel() {
            if (confirm('Apakah Anda yakin ingin membatalkan tiket ini? Tindakan ini tidak dapat dibatalkan.')) {
                window.location.href = 'proses_tiket.php?action=cancel&tiket_id=<?= $tiket_id ?>';
            }
        }
    </script>
</body>
</html>