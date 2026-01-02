<?php
session_start();
require_once 'config.php';

// Simulasi user login (ganti dengan sistem auth yang sebenarnya)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1; // Default user untuk demo
    $_SESSION['user_name'] = 'Demo User';
}

// Ambil data jenis transportasi
$stmt = $pdo->query("SELECT * FROM jenis_transportasi WHERE status = 'aktif' ORDER BY nama_transportasi");
$jenis_transportasi = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil rute berdasarkan jenis transportasi
$rute_list = [];
if (isset($_GET['jenis_id'])) {
    $stmt = $pdo->prepare("SELECT r.*, jt.nama_transportasi 
                           FROM rute r 
                           JOIN jenis_transportasi jt ON r.jenis_transportasi_id = jt.id 
                           WHERE r.jenis_transportasi_id = ? AND r.status = 'aktif'");
    $stmt->execute([$_GET['jenis_id']]);
    $rute_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Ambil tiket user
$stmt = $pdo->prepare("SELECT t.*, r.nama_rute, r.stasiun_awal, r.stasiun_akhir, 
                       jt.nama_transportasi, jt.icon
                       FROM tiket t
                       JOIN rute r ON t.rute_id = r.id
                       JOIN jenis_transportasi jt ON r.jenis_transportasi_id = jt.id
                       WHERE t.user_id = ?
                       ORDER BY t.created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$tiket_user = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Ticketing - CoreJKT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />

    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #1e88e5;
        }

        .transport-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .transport-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            border-color: var(--blue-soft);
        }

        .transport-card.active {
            border-color: var(--blue-soft);
            background-color: #e3f2fd;
        }

        .ticket-card {
            border-left: 5px solid #ffc107;
        }

        .badge-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .page-header {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-soft) 100%);
            color: white;
            padding: 50px 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">E-TICKETING JAKARTA</span>
            </a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3"><i class="fas fa-user"></i>
                    <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i> Dashboard</a>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container text-center">
            <i class="fas fa-ticket-alt fa-3x mb-3"></i>
            <h1 class="display-5 fw-bold mb-0">E-Ticketing Transportasi</h1>
            <p class="lead mt-2">Beli tiket transportasi publik secara digital dengan mudah dan cepat</p>
        </div>
    </section>

    <div class="container my-5">
        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="beli-tab" data-bs-toggle="tab" data-bs-target="#beli" type="button">
                    <i class="fas fa-shopping-cart"></i> Beli Tiket
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tiket-tab" data-bs-toggle="tab" data-bs-target="#tiket" type="button">
                    <i class="fas fa-ticket-alt"></i> Tiket Saya
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Tab Beli Tiket -->
            <div class="tab-pane fade show active" id="beli" role="tabpanel">
                <h3 class="mb-4">Pilih Jenis Transportasi</h3>
                <div class="row g-3 mb-5">
                    <?php foreach ($jenis_transportasi as $jenis): ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="card transport-card text-center p-4 <?= isset($_GET['jenis_id']) && $_GET['jenis_id'] == $jenis['id'] ? 'active' : '' ?>"
                                onclick="window.location.href='?jenis_id=<?= $jenis['id'] ?>#beli'">
                                <i class="fas <?= htmlspecialchars($jenis['icon']) ?> fa-3x mb-3"
                                    style="color: var(--blue-soft);"></i>
                                <h5><?= htmlspecialchars($jenis['nama_transportasi']) ?></h5>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (!empty($rute_list)): ?>
                    <h4 class="mb-3">Pilih Rute</h4>
                    <div class="row g-3">
                        <?php foreach ($rute_list as $rute): ?>
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h5 class="card-title"><?= htmlspecialchars($rute['nama_rute']) ?></h5>
                                                <p class="mb-1">
                                                    <i class="fas fa-map-marker-alt text-success"></i>
                                                    <?= htmlspecialchars($rute['stasiun_awal']) ?>
                                                </p>
                                                <p class="mb-1">
                                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                                    <?= htmlspecialchars($rute['stasiun_akhir']) ?>
                                                </p>
                                                <p class="mb-0 text-muted small">
                                                    <i class="fas fa-clock"></i> ~<?= $rute['durasi_menit'] ?> menit
                                                </p>
                                            </div>
                                            <div class="text-end">
                                                <h4 class="text-primary mb-2">Rp
                                                    <?= number_format($rute['harga'], 0, ',', '.') ?>
                                                </h4>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalBeli"
                                                    onclick="setRuteData(<?= htmlspecialchars(json_encode($rute)) ?>)">
                                                    <i class="fas fa-shopping-cart"></i> Beli
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php elseif (isset($_GET['jenis_id'])): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Tidak ada rute tersedia untuk transportasi ini.
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tab Tiket Saya -->
            <div class="tab-pane fade" id="tiket" role="tabpanel">
                <h3 class="mb-4">Daftar Tiket Saya</h3>
                <?php if (!empty($tiket_user)): ?>
                    <div class="row g-3">
                        <?php foreach ($tiket_user as $tiket): ?>
                            <div class="col-md-6">
                                <div class="card shadow-sm ticket-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1">
                                                    <i class="fas <?= htmlspecialchars($tiket['icon']) ?>"></i>
                                                    <?= htmlspecialchars($tiket['nama_transportasi']) ?>
                                                </h5>
                                                <span class="badge badge-status 
                                            <?php
                                            echo match ($tiket['status_tiket']) {
                                                'paid' => 'bg-success',
                                                'pending' => 'bg-warning text-dark',
                                                'used' => 'bg-secondary',
                                                'expired' => 'bg-danger',
                                                'cancelled' => 'bg-dark',
                                                default => 'bg-info'
                                            };
                                            ?>">
                                                    <?= strtoupper($tiket['status_tiket']) ?>
                                                </span>
                                            </div>
                                            <span class="text-muted"><?= $tiket['kode_tiket'] ?></span>
                                        </div>

                                        <p class="mb-1"><strong><?= htmlspecialchars($tiket['nama_rute']) ?></strong></p>
                                        <p class="mb-1 small">
                                            <i class="fas fa-map-marker-alt text-success"></i>
                                            <?= htmlspecialchars($tiket['stasiun_awal']) ?>
                                        </p>
                                        <p class="mb-2 small">
                                            <i class="fas fa-map-marker-alt text-danger"></i>
                                            <?= htmlspecialchars($tiket['stasiun_akhir']) ?>
                                        </p>

                                        <hr>

                                        <div class="row">
                                            <div class="col-6">
                                                <small class="text-muted">Tanggal</small>
                                                <p class="mb-0"><?= date('d/m/Y', strtotime($tiket['tanggal_perjalanan'])) ?>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">Waktu</small>
                                                <p class="mb-0"><?= date('H:i', strtotime($tiket['waktu_keberangkatan'])) ?></p>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <small class="text-muted">Total Harga</small>
                                                <h5 class="text-primary mb-0">Rp
                                                    <?= number_format($tiket['total_harga'], 0, ',', '.') ?>
                                                </h5>
                                            </div>
                                            <div>
                                                <?php if ($tiket['status_tiket'] == 'paid'): ?>
                                                    <a href="tiket_detail.php?id=<?= $tiket['id'] ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-qrcode"></i> Lihat QR
                                                    </a>
                                                <?php elseif ($tiket['status_tiket'] == 'pending'): ?>
                                                    <a href="pembayaran.php?tiket_id=<?= $tiket['id'] ?>"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fas fa-credit-card"></i> Bayar
                                                    </a>
                                                <?php endif; ?>
                                                <button class="btn btn-sm btn-info" onclick="detailTiket(<?= $tiket['id'] ?>)">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-ticket-alt fa-3x mb-3"></i>
                        <p class="mb-0">Anda belum memiliki tiket. Silakan beli tiket terlebih dahulu.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal Beli Tiket -->
    <div class="modal fade" id="modalBeli" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pembelian Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="proses_tiket.php" method="POST" id="formBeli">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="beli">
                        <input type="hidden" name="rute_id" id="rute_id">

                        <div id="rute-info" class="alert alert-info"></div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Perjalanan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_perjalanan" id="tanggal_perjalanan" class="form-control"
                                min="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Waktu Keberangkatan <span class="text-danger">*</span></label>
                            <input type="time" name="waktu_keberangkatan" id="waktu_keberangkatan" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah Penumpang <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_penumpang" id="jumlah_penumpang" class="form-control"
                                value="1" min="1" max="10" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Harga</label>
                            <input type="text" id="total_harga_display" class="form-control" readonly>
                            <input type="hidden" name="total_harga" id="total_harga">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btnSubmitBeli">
                            <i class="fas fa-check"></i> Lanjut ke Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <footer class="text-white py-4" style="background-color: #051025;">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 CoreJKT - E-Ticketing Jakarta</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fix JavaScript untuk form pembelian tiket
        let selectedRute = null;

        function setRuteData(rute) {
            console.log('Setting rute data:', rute); // Debug log

            selectedRute = rute;
            document.getElementById('rute_id').value = rute.id;

            // Update info rute
            document.getElementById('rute-info').innerHTML = `
        <strong>${rute.nama_rute}</strong><br>
        ${rute.stasiun_awal} → ${rute.stasiun_akhir}<br>
        Harga per orang: Rp ${parseInt(rute.harga).toLocaleString('id-ID')}
    `;

            // Reset dan calculate
            document.getElementById('jumlah_penumpang').value = 1;
            calculateTotal();

            console.log('Rute ID set to:', document.getElementById('rute_id').value); // Debug log
        }

        function calculateTotal() {
            if (!selectedRute) {
                console.log('No rute selected'); // Debug log
                return;
            }

            const jumlah = parseInt(document.getElementById('jumlah_penumpang').value) || 1;
            const total = selectedRute.harga * jumlah;

            document.getElementById('total_harga').value = total;
            document.getElementById('total_harga_display').value = 'Rp ' + parseInt(total).toLocaleString('id-ID');

            console.log('Total calculated:', total); // Debug log
        }

        // Event listener untuk jumlah penumpang
        const jumlahInput = document.getElementById('jumlah_penumpang');
        if (jumlahInput) {
            jumlahInput.addEventListener('input', calculateTotal);
        }

        // Validasi sebelum submit
        const formBeli = document.getElementById('formBeli');
        if (formBeli) {
            formBeli.addEventListener('submit', function (e) {
                console.log('Form submitting...'); // Debug log

                // Validasi manual
                const ruteId = document.getElementById('rute_id').value;
                const tanggal = document.getElementById('tanggal_perjalanan').value;
                const waktu = document.getElementById('waktu_keberangkatan').value;
                const jumlah = document.getElementById('jumlah_penumpang').value;
                const total = document.getElementById('total_harga').value;

                console.log('Form data:', { ruteId, tanggal, waktu, jumlah, total }); // Debug log

                if (!ruteId || !tanggal || !waktu || !jumlah || !total) {
                    e.preventDefault();
                    alert('Semua field harus diisi!');
                    return false;
                }

                if (parseInt(jumlah) < 1 || parseInt(jumlah) > 10) {
                    e.preventDefault();
                    alert('Jumlah penumpang harus antara 1-10');
                    return false;
                }

                // Jika lolos validasi, form akan submit
                console.log('Form validation passed, submitting...'); // Debug log
            });
        }

        function detailTiket(id) {
            window.location.href = 'tiket_detail.php?id=' + id;
        }
    </script>
</body>

</html>