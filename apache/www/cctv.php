<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CCTV Kota - CoreJKT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <style>
        :root {
            --jkt-blue: #051025;
            --jkt-accent: #00d2ff;
            --live-red: #ff3e3e;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
        }

        /* Header dengan Gradient Modern */
        .page-header {
            background: linear-gradient(135deg, var(--jkt-blue) 0%, #0a2558 100%);
            color: white;
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            opacity: 0.1;
        }

        /* Grid CCTV */
        .cctv-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        /* Feed Card Custom */
        .cctv-feed {
            position: relative;
            background-color: #000;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .cctv-feed:hover {
            transform: scale(1.02);
            border-color: var(--jkt-accent);
            box-shadow: 0 15px 30px rgba(0, 210, 255, 0.2);
            z-index: 10;
        }

        /* Efek Overlay Scanline */
        .cctv-feed::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.1) 50%),
                linear-gradient(90deg, rgba(255, 0, 0, 0.03), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.03));
            background-size: 100% 4px, 3px 100%;
            pointer-events: none;
        }

        .cctv-feed img {
            width: 100%;
            height: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            display: block;
            transition: opacity 0.3s;
        }

        /* Badge LIVE Berkedip */
        .cctv-status {
            background: rgba(255, 0, 0, 0.8);
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dot {
            width: 6px;
            height: 6px;
            background-color: white;
            border-radius: 50%;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Label Info */
        .cctv-label {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8) 0%, transparent 100%);
            padding: 12px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .cctv-location {
            font-size: 0.85rem;
            font-weight: 500;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }

        /* Jam Digital real-time pada feed */
        .timestamp {
            position: absolute;
            bottom: 10px;
            right: 12px;
            color: #00ff00;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.75rem;
            text-shadow: 1px 1px 2px black;
        }

        /* Filter Section */
        .filter-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            margin-top: -30px;
            position: relative;
            z-index: 100;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-3" style="background-color: var(--jkt-blue);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="assets/Logo1.png" alt="Logo" class="me-2" style="height: 40px;">
                <span class="fw-bold">CORE<span class="text-info">JKT</span> CCTV</span>
            </a>
            <a href="dashboard.php" class="btn btn-outline-info rounded-pill px-4">
                <i class="fas fa-arrow-left me-2"></i> Dashboard
            </a>
        </div>
    </nav>

    <header class="page-header">
        <div class="container text-center">
            <div class="mb-3">
                <i class="fas fa-broadcast-tower fa-3x text-info"></i>
            </div>
            <h1 class="display-5 fw-bold text-white">Jakarta Real-Time Monitoring</h1>
            <p class="lead opacity-75">Pantau arus lalu lintas dan kondisi keamanan ibu kota melalui jaringan CCTV
                terintegrasi.</p>
        </div>
    </header>

    <div class="container mb-5">
        <div class="filter-box mb-5">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label class="small fw-bold text-muted d-block mb-1 text-uppercase">Wilayah Pantauan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i
                                class="fas fa-map-marker-alt text-primary"></i></span>
                        <select class="form-select border-0 bg-light">
                            <option selected>Seluruh Jakarta</option>
                            <option>Jakarta Pusat</option>
                            <option>Jakarta Selatan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold text-muted d-block mb-1 text-uppercase">Cari Lokasi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control border-0 bg-light"
                            placeholder="Misal: Monas, Sudirman...">
                    </div>
                </div>
                <div class="col-md-4 text-md-end pt-md-4">
                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                        <i class="fas fa-signal me-1"></i> 1,240 Kamera Online
                    </span>
                </div>
            </div>
        </div>

        <div class="cctv-grid">
            <div class="cctv-feed">
                <div class="cctv-label">
                    <div class="cctv-location"><i class="fas fa-video me-2"></i>Bundaran Monas</div>
                    <div class="cctv-status">
                        <div class="dot"></div> LIVE
                    </div>
                </div>
                <img src="https://images.unsplash.com/photo-1582650625119-3a31f8fa2699?auto=format&fit=crop&w=600&q=80"
                    alt="CCTV">
                <div class="timestamp" id="time1">00:00:00</div>
            </div>

            <div class="cctv-feed">
                <div class="cctv-label">
                    <div class="cctv-location"><i class="fas fa-video me-2"></i>Bundaran HI</div>
                    <div class="cctv-status">
                        <div class="dot"></div> LIVE
                    </div>
                </div>
                <img src="https://images.unsplash.com/photo-1596716503004-9892c9431478?auto=format&fit=crop&w=600&q=80"
                    alt="CCTV">
                <div class="timestamp" id="time2">00:00:00</div>
            </div>

            <div class="cctv-feed">
                <div class="cctv-label">
                    <div class="cctv-location"><i class="fas fa-video me-2"></i>Simpang Semanggi</div>
                    <div class="cctv-status">
                        <div class="dot"></div> LIVE
                    </div>
                </div>
                <img src="https://images.unsplash.com/photo-1545147388-249f28003612?auto=format&fit=crop&w=600&q=80"
                    alt="CCTV">
                <div class="timestamp" id="time3">00:00:00</div>
            </div>

            <div class="cctv-feed">
                <div class="cctv-label">
                    <div class="cctv-location"><i class="fas fa-video me-2"></i>Kota Tua</div>
                    <div class="cctv-status">
                        <div class="dot"></div> LIVE
                    </div>
                </div>
                <img src="https://images.unsplash.com/photo-1570162590552-300803565860?auto=format&fit=crop&w=600&q=80"
                    alt="CCTV">
                <div class="timestamp" id="time4">00:00:00</div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button class="btn btn-dark btn-lg px-5 rounded-pill shadow">
                <i class="fas fa-sync-alt me-2"></i> Muat Lebih Banyak
            </button>
        </div>
    </div>

    <footer class="text-white py-4" style="background-color: var(--jkt-blue);">
        <div class="container text-center">
            <p class="mb-0 opacity-50">&copy; 2025 CoreJKT - Smart City Security System</p>
        </div>
    </footer>

    <script>
        // Update Timestamp Real-time di setiap feed
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleDateString('id-ID') + ' ' + now.toLocaleTimeString('id-ID');
            document.querySelectorAll('.timestamp').forEach(el => {
                el.innerText = timeString;
            });
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>

</html>