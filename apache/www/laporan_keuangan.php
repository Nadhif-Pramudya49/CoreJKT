<?php
session_start();

// Simulasi Data
$ringkasan = [
    "total_anggaran" => 1500000000,
    "terpakai" => 850000000,
    "sisa" => 650000000
];

$pengeluaran_kategori = [
    ["kategori" => "Fasilitas Kesehatan", "jumlah" => 400000000, "color" => "#4e73df", "icon" => "fa-hospital"],
    ["kategori" => "Pendidikan & Sekolah", "jumlah" => 300000000, "color" => "#1cc88a", "icon" => "fa-graduation-cap"],
    ["kategori" => "Infrastruktur IT", "jumlah" => 100000000, "color" => "#36b9cc", "icon" => "fa-microchip"],
    ["kategori" => "Operasional", "jumlah" => 50000000, "color" => "#f6c23e", "icon" => "fa-cogs"]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Transparansi - CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0d6efd;
            --dark-bg: #f8f9fc;
            --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark-bg);
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, #051025 0%, #0d6efd 100%);
            border-bottom: 3px solid #ffc107;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-card::after {
            content: "";
            position: absolute;
            right: -20px;
            bottom: -20px;
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            font-size: 5rem;
            opacity: 0.1;
        }

        .card-budget::after {
            content: "\f153";
        }

        .card-spent::after {
            content: "\f201";
        }

        .card-balance::after {
            content: "\f53d";
        }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
        }

        .progress {
            border-radius: 10px;
            background-color: #eaecf4;
        }

        .chart-area {
            position: relative;
            height: 300px;
        }

        .counter-value {
            font-size: 1.8rem;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="fas fa-shield-halved me-2 text-warning"></i>
                <span class="fw-bold tracking-tight">CORE<span class="text-warning">JKT</span> TRANSPARANSI</span>
            </a>
            <a href="dashboard.php" class="btn btn-outline-light btn-sm rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row mb-5 align-items-center">
            <div class="col-md-7">
                <h1 class="fw-bold text-dark mb-1">Laporan Realisasi Anggaran</h1>
                <p class="text-secondary">Periode Tahun Anggaran 2025 - Update Terakhir: <?= date('d M Y') ?></p>
            </div>
            <div class="col-md-5 text-md-end">
                <button class="btn btn-white shadow-sm border rounded-pill px-4" onclick="window.print()">
                    <i class="fas fa-download me-2 text-primary"></i> Unduh PDF
                </button>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card stat-card card-budget bg-primary text-white p-4 h-100 shadow">
                    <small class="text-uppercase fw-bold opacity-75">Total Anggaran</small>
                    <div class="counter-value" data-target="<?= $ringkasan['total_anggaran'] ?>">0</div>
                    <div class="mt-2 small"><i class="fas fa-info-circle me-1"></i> Alokasi Dana Pusat</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card card-spent bg-white p-4 h-100 shadow-sm border-start border-danger border-5">
                    <small class="text-uppercase fw-bold text-muted">Dana Terpakai</small>
                    <div class="counter-value text-danger" data-target="<?= $ringkasan['terpakai'] ?>">0</div>
                    <div class="mt-2 small text-muted">Diserap oleh 4 Sektor Utama</div>
                </div>
            </div>
            <div class="col-md-4">
                <div
                    class="card stat-card card-balance bg-white p-4 h-100 shadow-sm border-start border-success border-5">
                    <small class="text-uppercase fw-bold text-muted">Sisa Saldo</small>
                    <div class="counter-value text-success" data-target="<?= $ringkasan['sisa'] ?>">0</div>
                    <div class="mt-2 small text-muted">Tersedia untuk Alokasi Cadangan</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="table-container h-100">
                    <h5 class="fw-bold mb-4 text-center">Distribusi Anggaran</h5>
                    <div class="chart-area">
                        <canvas id="financeChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="table-container h-100">
                    <h5 class="fw-bold mb-4">Rincian Penggunaan Dana</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-muted small text-uppercase">
                                <tr>
                                    <th>Kategori Sektor</th>
                                    <th>Realisasi (Rp)</th>
                                    <th width="30%">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pengeluaran_kategori as $p):
                                    $persen = ($p['jumlah'] / $ringkasan['total_anggaran']) * 100;
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="btn btn-sm btn-light rounded-3 me-3 text-primary"
                                                    style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                                                    <i class="fas <?= $p['icon'] ?>"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold"><?= $p['kategori'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="fw-bold">Rp <?= number_format($p['jumlah'], 0, ',', '.') ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress w-100 me-2" style="height: 6px;">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: <?= $persen ?>%; background-color: <?= $p['color'] ?>;">
                                                    </div>
                                                </div>
                                                <small class="text-muted"><?= round($persen, 1) ?>%</small>
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

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 opacity-75 small">&copy; 2025 CoreJKT Monitoring System. Sistem Navigasi Pintar Jakarta.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // 1. Animasi Counter Angka
        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1500; // ms
            const increment = target / (duration / 16);

            const updateCount = () => {
                const count = +counter.innerText.replace(/\D/g, '');
                if (count < target) {
                    const nextVal = Math.ceil(count + increment);
                    counter.innerText = "Rp " + new Intl.NumberFormat('id-ID').format(nextVal > target ? target : nextVal);
                    setTimeout(updateCount, 16);
                }
            };
            updateCount();
        });

        // 2. Inisialisasi Chart.js Modern
        const ctx = document.getElementById('financeChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_column($pengeluaran_kategori, 'kategori')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($pengeluaran_kategori, 'jumlah')) ?>,
                    backgroundColor: <?= json_encode(array_column($pengeluaran_kategori, 'color')) ?>,
                    hoverOffset: 20,
                    borderWidth: 4,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { padding: 20, usePointStyle: true, font: { family: 'Inter', size: 12 } }
                    }
                },
                cutout: '75%'
            }
        });
    </script>
</body>

</html>