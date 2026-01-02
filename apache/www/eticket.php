<?php
session_start();
require_once 'config.php';

// // Cek login
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

// $user_id = $_SESSION['user_id'];

// Ambil data jenis transportasi
$stmt = $pdo->query("SELECT * FROM jenis_transportasi WHERE status = 'aktif'");
$transportasi_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticketing - CoreJKT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #1e3a8a;
        }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .step {
            flex: 1;
            text-align: center;
            padding: 10px;
            background: #e9ecef;
            position: relative;
        }
        .step.active {
            background: var(--blue-soft);
            color: white;
        }
        .step.completed {
            background: #28a745;
            color: white;
        }
        .transport-card {
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
        }
        .transport-card:hover {
            border-color: var(--blue-soft);
            transform: translateY(-5px);
        }
        .transport-card.selected {
            border-color: var(--blue-soft);
            background-color: #e7f3ff;
        }
        .jadwal-item {
            cursor: pointer;
            transition: all 0.3s;
        }
        .jadwal-item:hover {
            background-color: #f8f9fa;
        }
        .jadwal-item.selected {
            background-color: #e7f3ff;
            border-left: 4px solid var(--blue-soft);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text">E-TICKETING</span>
            </a>
            <div class="d-flex align-items-center">
                <a href="history_tiket.php" class="btn btn-outline-light me-2">
                    <i class="fas fa-history"></i> History
                </a>
                <a href="transportasi.php" class="btn btn-success">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step active" id="step1-indicator">
                <i class="fas fa-bus"></i>
                <div>Pilih Transportasi</div>
            </div>
            <div class="step" id="step2-indicator">
                <i class="fas fa-route"></i>
                <div>Pilih Rute</div>
            </div>
            <div class="step" id="step3-indicator">
                <i class="fas fa-clock"></i>
                <div>Pilih Jadwal</div>
            </div>
            <div class="step" id="step4-indicator">
                <i class="fas fa-shopping-cart"></i>
                <div>Konfirmasi</div>
            </div>
        </div>

        <!-- Step 1: Pilih Transportasi -->
        <div id="step1" class="step-content">
            <h3 class="mb-4 text-center">Pilih Jenis Transportasi</h3>
            <div class="row g-4">
                <?php foreach ($transportasi_list as $transport): ?>
                <div class="col-md-3">
                    <div class="card transport-card h-100" onclick="selectTransport(<?php echo $transport['id']; ?>, '<?php echo htmlspecialchars($transport['nama_transportasi']); ?>')">
                        <div class="card-body text-center">
                            <i class="fas <?php echo $transport['icon']; ?> fa-3x mb-3" style="color: var(--blue-soft);"></i>
                            <h5><?php echo htmlspecialchars($transport['nama_transportasi']); ?></h5>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Step 2: Pilih Rute -->
        <div id="step2" class="step-content d-none">
            <h3 class="mb-4 text-center">Pilih Rute Perjalanan</h3>
            <div id="rute-list" class="list-group"></div>
            <button class="btn btn-secondary mt-3" onclick="backToStep(1)">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </div>

        <!-- Step 3: Pilih Jadwal -->
        <div id="step3" class="step-content d-none">
            <h3 class="mb-4 text-center">Pilih Jadwal & Tanggal</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Perjalanan</label>
                    <input type="date" class="form-control" id="tanggal_perjalanan" min="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div id="jadwal-list" class="list-group"></div>
            <button class="btn btn-secondary mt-3" onclick="backToStep(2)">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </div>

        <!-- Step 4: Konfirmasi -->
        <div id="step4" class="step-content d-none">
            <h3 class="mb-4 text-center">Konfirmasi Pemesanan</h3>
            <form id="formPesan" method="POST" action="proses_pesan.php">
                <input type="hidden" name="jadwal_id" id="hidden_jadwal_id">
                <input type="hidden" name="tanggal_perjalanan" id="hidden_tanggal">
                <input type="hidden" name="total_harga" id="hidden_total">
                
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Detail Perjalanan</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Transportasi</strong></td>
                                <td id="confirm_transport">-</td>
                            </tr>
                            <tr>
                                <td><strong>Rute</strong></td>
                                <td id="confirm_rute">-</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal</strong></td>
                                <td id="confirm_tanggal">-</td>
                            </tr>
                            <tr>
                                <td><strong>Waktu</strong></td>
                                <td id="confirm_waktu">-</td>
                            </tr>
                            <tr>
                                <td><strong>Harga</strong></td>
                                <td id="confirm_harga">-</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Data Penumpang</h5>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_penumpang" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="tel" class="form-control" name="no_telepon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Tiket</label>
                            <input type="number" class="form-control" name="jumlah_tiket" id="jumlah_tiket" value="1" min="1" max="5" required onchange="updateTotal()">
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Metode Pembayaran</h5>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" id="gopay" value="GoPay" required>
                            <label class="form-check-label" for="gopay">
                                <i class="fas fa-wallet"></i> GoPay
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" id="ovo" value="OVO">
                            <label class="form-check-label" for="ovo">
                                <i class="fas fa-wallet"></i> OVO
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" id="dana" value="DANA">
                            <label class="form-check-label" for="dana">
                                <i class="fas fa-wallet"></i> DANA
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metode_pembayaran" id="transfer" value="Transfer Bank">
                            <label class="form-check-label" for="transfer">
                                <i class="fas fa-university"></i> Transfer Bank
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h4 class="mb-0">Total Pembayaran: <span id="total_display" class="text-primary">Rp 0</span></h4>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" onclick="backToStep(3)">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-check"></i> Konfirmasi Pemesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedData = {
            transport_id: null,
            transport_name: null,
            rute_id: null,
            rute_name: null,
            jadwal_id: null,
            jadwal_waktu: null,
            harga: 0
        };

        function selectTransport(id, name) {
            selectedData.transport_id = id;
            selectedData.transport_name = name;
            
            // Visual feedback
            document.querySelectorAll('.transport-card').forEach(card => {
                card.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
            
            // Load rute
            setTimeout(() => {
                loadRute(id);
                goToStep(2);
            }, 300);
        }

        function loadRute(transport_id) {
            fetch(`get_rute.php?transport_id=${transport_id}`)
                .then(response => response.json())
                .then(data => {
                    const ruteList = document.getElementById('rute-list');
                    ruteList.innerHTML = '';
                    
                    data.forEach(rute => {
                        const item = document.createElement('div');
                        item.className = 'list-group-item list-group-item-action';
                        item.style.cursor = 'pointer';
                        item.innerHTML = `
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">${rute.nama_rute}</h5>
                                    <p class="mb-1 text-muted">
                                        <i class="fas fa-map-marker-alt"></i> ${rute.stasiun_awal} 
                                        <i class="fas fa-arrow-right mx-2"></i> 
                                        ${rute.stasiun_akhir}
                                    </p>
                                    <small><i class="fas fa-clock"></i> ${rute.durasi_menit} menit</small>
                                </div>
                                <div class="text-end">
                                    <h5 class="text-primary mb-0">Rp ${Number(rute.harga).toLocaleString('id-ID')}</h5>
                                </div>
                            </div>
                        `;
                        item.onclick = () => selectRute(rute.id, rute.nama_rute, rute.stasiun_awal, rute.stasiun_akhir, rute.harga);
                        ruteList.appendChild(item);
                    });
                });
        }

        function selectRute(id, name, awal, akhir, harga) {
            selectedData.rute_id = id;
            selectedData.rute_name = `${awal} → ${akhir}`;
            selectedData.harga = parseFloat(harga);
            
            setTimeout(() => {
                loadJadwal(id);
                goToStep(3);
            }, 300);
        }

        function loadJadwal(rute_id) {
            fetch(`get_jadwal.php?rute_id=${rute_id}`)
                .then(response => response.json())
                .then(data => {
                    const jadwalList = document.getElementById('jadwal-list');
                    jadwalList.innerHTML = '';
                    
                    data.forEach(jadwal => {
                        const item = document.createElement('div');
                        item.className = 'list-group-item jadwal-item';
                        item.innerHTML = `
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1"><i class="fas fa-clock"></i> ${jadwal.waktu_keberangkatan}</h5>
                                    <small class="text-muted">Kapasitas: ${jadwal.kapasitas} kursi | ${jadwal.hari_operasi}</small>
                                </div>
                                <button class="btn btn-sm btn-primary">Pilih</button>
                            </div>
                        `;
                        item.onclick = () => selectJadwal(jadwal.id, jadwal.waktu_keberangkatan);
                        jadwalList.appendChild(item);
                    });
                });
        }

        function selectJadwal(id, waktu) {
            const tanggal = document.getElementById('tanggal_perjalanan').value;
            if (!tanggal) {
                alert('Pilih tanggal perjalanan terlebih dahulu!');
                return;
            }
            
            selectedData.jadwal_id = id;
            selectedData.jadwal_waktu = waktu;
            
            // Set konfirmasi
            document.getElementById('confirm_transport').textContent = selectedData.transport_name;
            document.getElementById('confirm_rute').textContent = selectedData.rute_name;
            document.getElementById('confirm_tanggal').textContent = new Date(tanggal).toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('confirm_waktu').textContent = waktu;
            document.getElementById('confirm_harga').textContent = `Rp ${selectedData.harga.toLocaleString('id-ID')} / tiket`;
            
            document.getElementById('hidden_jadwal_id').value = id;
            document.getElementById('hidden_tanggal').value = tanggal;
            
            updateTotal();
            goToStep(4);
        }

        function updateTotal() {
            const jumlah = parseInt(document.getElementById('jumlah_tiket').value) || 1;
            const total = selectedData.harga * jumlah;
            document.getElementById('total_display').textContent = `Rp ${total.toLocaleString('id-ID')}`;
            document.getElementById('hidden_total').value = total;
        }

        function goToStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(content => {
                content.classList.add('d-none');
            });
            
            // Show selected step
            document.getElementById(`step${step}`).classList.remove('d-none');
            
            // Update indicators
            for (let i = 1; i <= 4; i++) {
                const indicator = document.getElementById(`step${i}-indicator`);
                indicator.classList.remove('active', 'completed');
                if (i < step) {
                    indicator.classList.add('completed');
                } else if (i === step) {
                    indicator.classList.add('active');
                }
            }
        }

        function backToStep(step) {
            goToStep(step);
        }
    </script>
</body>
</html>