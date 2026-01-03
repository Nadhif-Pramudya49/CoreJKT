<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agenda Kegiatan - Peluncuran CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --jkt-blue: #051025;
            --jkt-soft: #0d6efd;
            --jkt-accent: #00d2ff;
        }

        body {
            background-color: #f4f7fa;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--jkt-blue);
        }

        /* Header dengan Gradient & Mesh */
        .page-header {
            background: linear-gradient(135deg, var(--jkt-blue) 0%, var(--jkt-soft) 100%);
            color: white;
            padding: 80px 0 120px;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0% 100%);
            position: relative;
        }

        /* Countdown Timer Styling */
        #countdown {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .countdown-item {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            padding: 15px;
            border-radius: 15px;
            min-width: 85px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .countdown-number {
            font-size: 1.8rem;
            font-weight: 800;
            display: block;
            line-height: 1.2;
            font-family: 'Courier New', Courier, monospace;
            /* Monospace agar angka tidak bergeser */
        }

        .countdown-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            opacity: 0.9;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Highlight Detik */
        .item-seconds {
            border-color: var(--jkt-accent);
            color: var(--jkt-accent);
        }

        /* Timeline Styling */
        .timeline {
            position: relative;
            max-width: 900px;
            margin: -50px auto 0;
            padding: 20px;
        }

        .rundown-item {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .rundown-item:hover {
            transform: scale(1.02) translateX(10px);
            box-shadow: 0 15px 40px rgba(13, 110, 253, 0.1);
        }

        .time-box {
            background: var(--jkt-soft);
            color: white;
            padding: 15px;
            border-radius: 15px;
            font-weight: 800;
            min-width: 120px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }

        .rundown-content h5 {
            font-weight: 800;
            margin-bottom: 5px;
            color: var(--jkt-blue);
        }

        .session-major {
            background: linear-gradient(to right, #fff5f5, #ffffff);
            border-left: 8px solid #dc3545;
        }

        .session-major .time-box {
            background: #dc3545;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .info-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: var(--jkt-soft);
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3" style="background-color: var(--jkt-blue);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
                <span class="brand-text fw-bold">AGENDA <span class="text-info">COREJKT</span></span>
            </a>
            <a href="dashboard.php" class="btn btn-outline-info rounded-pill px-4 btn-sm">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </div>
    </nav>

    <header class="page-header">
        <div class="container text-center" data-aos="zoom-in">
            <i class="fas fa-rocket fa-3x mb-3 text-info"></i>
            <h1 class="display-4 fw-bold mb-0">Grand Launching CoreJKT</h1>
            <p class="lead mt-2 opacity-75">Transformasi Digital Menuju Jakarta Kota Global</p>

            <div id="countdown">
                <div class="countdown-item">
                    <span class="countdown-number" id="days">07</span>
                    <span class="countdown-label">Hari</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="hours">00</span>
                    <span class="countdown-label">Jam</span>
                </div>
                <div class="countdown-item">
                    <span class="countdown-number" id="minutes">00</span>
                    <span class="countdown-label">Menit</span>
                </div>
                <div class="countdown-item item-seconds">
                    <span class="countdown-number" id="seconds">00</span>
                    <span class="countdown-label">Detik</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <div class="row g-4 mb-5">
            <div class="col-md-6" data-aos="fade-right">
                <div class="info-card">
                    <div class="icon-circle"><i class="fas fa-location-dot"></i></div>
                    <h4 class="fw-bold">Lokasi & Waktu</h4>
                    <p class="text-secondary">Pertemuan eksklusif yang diadakan di jantung pemerintahan DKI Jakarta.</p>
                    <hr>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-calendar text-info me-2"></i> 14 Desember 2025</li>
                        <li class="mb-2"><i class="fas fa-clock text-info me-2"></i> 09.00 - 12.00 WIB</li>
                        <li class="mb-2"><i class="fas fa-building text-info me-2"></i> Balai Kota, Ruang Pola</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <div class="info-card">
                    <div class="icon-circle"><i class="fas fa-microphone"></i></div>
                    <h4 class="fw-bold">Panel Pembicara</h4>
                    <p class="text-secondary">Dihadiri oleh pemangku kepentingan strategis dan tim ahli teknologi.</p>
                    <hr>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-2 rounded-circle me-3"><i class="fas fa-user-tie text-primary"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Pj. Gubernur DKI Jakarta</h6><small class="text-muted">Keynote
                                Speaker</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-2 rounded-circle me-3"><i class="fas fa-code text-success"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Technical Lead CoreJKT</h6><small class="text-muted">Product
                                Demo</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center mb-5 fw-bold" data-aos="fade-up">Rundown Acara</h2>

        <div class="timeline">
            <div class="rundown-item" data-aos="fade-up">
                <div class="time-box">09:00 - 09:30</div>
                <div class="rundown-content">
                    <h5>Registrasi & Networking</h5>
                    <p class="mb-0 text-secondary small">Penyambutan tamu, Coffee Morning, dan sesi interaktif di
                        Experience Zone.</p>
                </div>
            </div>

            <div class="rundown-item" data-aos="fade-up">
                <div class="time-box">09:30 - 09:45</div>
                <div class="rundown-content">
                    <h5>Opening Ceremony</h5>
                    <p class="mb-0 text-secondary small">Lagu Kebangsaan Indonesia Raya dan sambutan pembukaan oleh
                        Kadis Kominfotik.</p>
                </div>
            </div>

            <div class="rundown-item" data-aos="fade-up">
                <div class="time-box">09:45 - 10:15</div>
                <div class="rundown-content">
                    <h5>Product Reveal & Tech Demo</h5>
                    <p class="mb-0 text-secondary small">Live demo fitur AI Navigation, E-Lapor 2.0, dan integrasi Big
                        Data Jakarta.</p>
                </div>
            </div>

            <div class="rundown-item session-major" data-aos="zoom-in">
                <div class="time-box">10:45 - 11:00</div>
                <div class="rundown-content">
                    <h5 class="text-danger">Momentum Peresmian</h5>
                    <p class="mb-0 text-secondary small fw-bold">Prosesi penekanan layar sentuh peresmian CoreJKT oleh
                        Pj. Gubernur.</p>
                </div>
            </div>

            <div class="rundown-item" data-aos="fade-up">
                <div class="time-box">11:00 - 11:30</div>
                <div class="rundown-content">
                    <h5>Press Conference / Q&A</h5>
                    <p class="mb-0 text-secondary small">Sesi diskusi terbuka dengan rekan media dan undangan VIP.</p>
                </div>
            </div>

            <div class="rundown-item" data-aos="fade-up">
                <div class="time-box">11:30 - 12:00</div>
                <div class="rundown-content">
                    <h5>Ramah Tamah</h5>
                    <p class="mb-0 text-secondary small">Makan siang bersama dan penutupan acara.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white py-5" style="background-color: var(--jkt-blue);">
        <div class="container text-center text-white-50 small">
            <img src="assets/Logo1.png" alt="Logo" style="height: 50px;" class="mb-3 grayscale brightness-200">
            <p>&copy; 2026 CoreJKT Smart City Platform. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inisialisasi AOS
        AOS.init({ duration: 1000, once: true });

        // LOGIKA HITUNG MUNDUR 7 HARI
        // Menetapkan target: waktu sekarang + 7 hari
        const countdownDuration = 7 * 24 * 60 * 60 * 1000; // 7 hari dalam milidetik
        const targetDate = new Date().getTime() + countdownDuration;

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                document.getElementById("countdown").innerHTML = "<h4 class='text-white'>Peluncuran Sedang Berlangsung!</h4>";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Update elemen dengan format 2 digit (01, 02, dst)
            document.getElementById("days").innerText = days.toString().padStart(2, '0');
            document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');
        }

        // Jalankan fungsi setiap detik
        setInterval(updateCountdown, 1000);
        updateCountdown(); // Jalankan sekali saat load agar tidak menunggu 1 detik
    </script>
</body>

</html>