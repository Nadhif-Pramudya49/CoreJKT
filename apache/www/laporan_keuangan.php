<?php
session_start();
// require_once __DIR__ . "/config.php";

// Simulasi Data Anggaran & Pengeluaran (Bisa ditarik dari Database)
$ringkasan = [
    "total_anggaran" => 1500000000, // 1.5 Miliar
    "terpakai" => 850000000,
    "sisa" => 650000000
];

$pengeluaran_kategori = [
    ["kategori" => "Fasilitas Kesehatan", "jumlah" => 400000000, "color" => "#0d6efd"],
    ["kategori" => "Pendidikan & Sekolah", "jumlah" => 300000000, "color" => "#6610f2"],
    ["kategori" => "Infrastruktur IT", "jumlah" => 100000000, "color" => "#0dcaf0"],
    ["kategori" => "Operasional", "jumlah" => 50000000, "color" => "#ffc107"]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan - CoreJKT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        .feature-box {
            transition: all 0.3s ease;
            border-left: 5px solid #ffc107;
            cursor: pointer;
            min-height: 200px;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 3rem;
            color: var(--blue-dark);
            margin-bottom: 15px;
        }

        .info-card .card-icon {
            color: #ffc107;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">LAPORAN KEUANGAN</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="dashboard.php" class="btn btn-success-custom"><i class="fas fa-home"></i>
                    Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: var(--blue-dark);">Laporan Transparansi Keuangan</h2>
                <p class="text-muted">Ringkasan alokasi dana pembangunan sistem navigasi Jakarta 2025.</p>
            </div>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-md-4">
                <div class="card stat-card shadow-sm p-3 bg-primary text-white">
                    <small>Total Anggaran</small>
                    <h3 class="fw-bold">Rp <?= number_format($ringkasan['total_anggaran'], 0, ',', '.') ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm p-3 bg-white">
                    <small class="text-muted">Dana Terpakai</small>
                    <h3 class="fw-bold text-danger">Rp <?= number_format($ringkasan['terpakai'], 0, ',', '.') ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card shadow-sm p-3 bg-white">
                    <small class="text-muted">Sisa Saldo</small>
                    <h3 class="fw-bold text-success">Rp <?= number_format($ringkasan['sisa'], 0, ',', '.') ?></h3>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="table-container text-center">
                    <h6 class="fw-bold mb-4">Alokasi Dana Per Sektor</h6>
                    <canvas id="financeChart" style="max-height: 300px;"></canvas>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="table-container">
                    <h6 class="fw-bold mb-3">Detail Pengeluaran</h6>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Nilai</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengeluaran_kategori as $p):
                                    $persen = ($p['jumlah'] / $ringkasan['total_anggaran']) * 100;
                                    ?>
                                    <tr>
                                        <td><i class="fas fa-circle me-2" style="color: <?= $p['color'] ?>;"></i>
                                            <?= $p['kategori'] ?></td>
                                        <td class="fw-bold">Rp <?= number_format($p['jumlah'], 0, ',', '.') ?></td>
                                        <td>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar"
                                                    style="width: <?= $persen ?>%; background-color: <?= $p['color'] ?>;">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: #051025 !important;">
        <div class="container text-center">
            <p>&copy; 2025 CoreJKT - Laporan Keuangan DKI Jakarta.</p>
        </div>
    </footer>

    <script>
        // Inisialisasi Chart.js
        const ctx = document.getElementById('financeChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_column($pengeluaran_kategori, 'kategori')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($pengeluaran_kategori, 'jumlah')) ?>,
                    backgroundColor: <?= json_encode(array_column($pengeluaran_kategori, 'color')) ?>,
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' }
                },
                cutout: '70%'
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>