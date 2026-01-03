<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jelajahi Jakarta - CoreJKT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root {
            --blue-dark: #051025;
            --blue-soft: #0d6efd;
            --jkt-accent: #ffc107;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
        }

        /* Header Modern */
        .page-header {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue-soft) 100%);
            color: white;
            padding: 80px 0;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
        }

        /* Peta Card */
        .map-section {
            margin-top: -50px;
            z-index: 10;
            position: relative;
        }

        #map {
            height: 500px;
            border-radius: 20px;
            border: 5px solid white;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* Destinasi Card */
        .place-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .place-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .card-img-container {
            position: relative;
            overflow: hidden;
            height: 220px;
        }

        .place-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .place-card:hover img {
            transform: scale(1.1);
        }

        .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(13, 110, 253, 0.9);
            color: white;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: bold;
            backdrop-filter: blur(5px);
        }

        .btn-detail {
            border-radius: 50px;
            font-weight: 600;
            padding: 8px 20px;
            background-color: var(--blue-soft);
            color: white;
            border: none;
            transition: 0.3s;
        }

        .btn-detail:hover {
            background-color: var(--blue-dark);
            color: white;
            transform: scale(1.05);
        }

        /* Search Bar */
        .search-container {
            background: white;
            padding: 20px;
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3" style="background-color: var(--blue-dark);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
                <img src="assets/Logo1.png" alt="Logo CoreJKT" class="me-2" style="height: 40px;">
                <span class="brand-text fw-bold">JELAJAHI <span class="text-info">JAKARTA</span></span>
            </a>
            <a href="dashboard.php" class="btn btn-outline-info rounded-pill px-4 btn-sm">
                <i class="fas fa-home me-2"></i>Dashboard
            </a>
        </div>
    </nav>

    <header class="page-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Wisata, Kuliner & Budaya</h1>
            <p class="lead opacity-75">Temukan sisi menarik Jakarta yang belum pernah Anda lihat sebelumnya.</p>
        </div>
    </header>

    <div class="container map-section mb-5">
        <div id="map"></div>
    </div>

    <div class="container mb-5">
        <div class="search-container row g-3 align-items-center mx-auto" style="max-width: 900px;">
            <div class="col-md-7">
                <div class="input-group border-0">
                    <span class="input-group-text bg-transparent border-0"><i
                            class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control border-0" placeholder="Cari destinasi impian Anda...">
                </div>
            </div>
            <div class="col-md-5">
                <select class="form-select border-0 bg-light rounded-pill">
                    <option selected>Semua Kategori</option>
                    <option>Wisata Sejarah</option>
                    <option>Kuliner Hits</option>
                    <option>Taman Kota</option>
                    <option>Seni & Galeri</option>
                </select>
            </div>
        </div>
    </div>

    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="fw-bold mb-0">Destinasi Terpopuler</h2>
                    <p class="text-muted mb-0">Rekomendasi terbaik minggu ini di Jakarta.</p>
                </div>
                <a href="#" class="btn btn-link text-decoration-none fw-bold">Lihat Semua <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm">
                        <div class="card-img-container">
                            <span class="category-badge">SEJARAH</span>
                            <img src="assets/kotatua.jpg" alt="Kota Tua">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Kota Tua (Batavia)</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Barat</p>
                            <p class="card-text text-secondary small">Jelajahi sisa kejayaan kolonial dengan bangunan
                                art-deco yang megah dan museum bersejarah.</p>
                            <button onclick="moveToMarker(-6.1352, 106.8133)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm">
                        <div class="card-img-container">
                            <span class="category-badge">BUDAYA</span>
                            <img src="assets/tmii.jpg" alt="TMII">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Taman Mini (TMII)</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Timur</p>
                            <p class="card-text text-secondary small">Seluruh budaya Indonesia dalam satu taman. Nikmati
                                kereta gantung dan paviliun tradisional.</p>
                            <button onclick="moveToMarker(-6.3024, 106.8952)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm">
                        <div class="card-img-container">
                            <span class="category-badge">IKONIK</span>
                            <img src="assets/monas.jpg"
                                alt="Monas">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Monas</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Pusat</p>
                            <p class="card-text text-secondary small">Monumen kebanggaan bangsa dengan pelataran emas
                                dan pemandangan kota dari ketinggian.</p>
                            <button onclick="moveToMarker(-6.1754, 106.8272)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm">
                        <div class="card-img-container">
                            <span class="category-badge">HIBURAN</span>
                            <img src="assets/Dufan.jpeg"
                                alt="Ancol">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Ancol Dreamland</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Utara</p>
                            <p class="card-text text-secondary small">Kawasan rekreasi pantai terbesar dengan Dufan,
                                SeaWorld, dan berbagai resort menarik.</p>
                            <button onclick="moveToMarker(-6.1256, 106.8436)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm">
                        <div class="card-img-container">
                            <span class="category-badge">SENI</span>
                            <img src="assets/galerinasional.jpg"
                                alt="Galeri Nasional">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Galeri Nasional</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Pusat</p>
                            <p class="card-text text-secondary small">Rumah bagi ribuan koleksi seni rupa modern dan
                                kontemporer terbaik di Indonesia.</p>
                            <button onclick="moveToMarker(-6.1783, 106.8327)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm">
                        <div class="card-img-container">
                            <span class="category-badge">KULINER</span>
                            <img src="assets/blok m.jpg" alt="M Bloc Space">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">M Bloc Space</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Selatan</p>
                            <p class="card-text text-secondary small">Tempat nongkrong kekinian hasil revitalisasi
                                bangunan tua menjadi pusat kreatif dan kuliner.</p>
                            <button onclick="moveToMarker(-6.2430, 106.7982)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm h-100">
                        <div class="card-img-container">
                            <span class="category-badge">SENI</span>
                            <img src="assets/tim.jpg" alt="Taman Ismail Marzuki">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Taman Ismail Marzuki</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Pusat</p>
                            <p class="card-text text-secondary small">Pusat kesenian dan kebudayaan dengan perpustakaan
                                modern yang estetik dan planetarium kelas dunia.</p>
                            <button onclick="moveToMarker(-6.1901, 106.8373)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm h-100">
                        <div class="card-img-container">
                            <span class="category-badge">EDUKASI</span>
                            <img src="assets/ragunan.jpg" alt="Ragunan">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Kebun Binatang Ragunan</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Selatan</p>
                            <p class="card-text text-secondary small">Rumah bagi ribuan satwa tropis di lahan terbuka
                                hijau yang luas. Cocok untuk piknik keluarga.</p>
                            <button onclick="moveToMarker(-6.3124, 106.8202)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm h-100">
                        <div class="card-img-container">
                            <span class="category-badge">BELANJA</span>
                            <img src="assets/sarinah.jpg" alt="Sarinah">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Sarinah Thamrin</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Pusat</p>
                            <p class="card-text text-secondary small">Pusat perbelanjaan tertua yang kini
                                bertransformasi menjadi wadah kreatif produk lokal dan UMKM Indonesia.</p>
                            <button onclick="moveToMarker(-6.1894, 106.8244)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm h-100">
                        <div class="card-img-container">
                            <span class="category-badge">KULINER</span>
                            <img src="assets/sabang.jpg" alt="Jalan Sabang">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Kuliner Jalan Sabang</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Pusat</p>
                            <p class="card-text text-secondary small">Surga kuliner malam mulai dari sate legendaris
                                hingga masakan modern di sepanjang trotoar Thamrin.</p>
                            <button onclick="moveToMarker(-6.1856, 106.8247)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm h-100">
                        <div class="card-img-container">
                            <span class="category-badge">TAMAN</span>
                            <img src="assets/gbk.jpg" alt="Hutan Kota GBK">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Hutan Kota GBK</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Pusat</p>
                            <p class="card-text text-secondary small">Area terbuka hijau dengan pemandangan pencakar
                                langit SCBD. Tempat terbaik untuk santai sore.</p>
                            <button onclick="moveToMarker(-6.2238, 106.8064)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm h-100">
                        <div class="card-img-container">
                            <span class="category-badge">SENI</span>
                            <img src="assets/macan.jpg" alt="Museum MACAN">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Museum MACAN</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Barat</p>
                            <p class="card-text text-secondary small">Museum seni modern dan kontemporer yang populer
                                dengan instalasi unik "Infinity Mirrored Room".</p>
                            <button onclick="moveToMarker(-6.1907, 106.7674)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card place-card shadow-sm h-100">
                        <div class="card-img-container">
                            <span class="category-badge">REKREASI</span>
                            <img src="assets/pik.jpg" alt="Pantai PIK 2">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Pantai Indah Kapuk 2</h5>
                            <p class="small text-muted mb-2"><i
                                    class="fas fa-map-marker-alt text-danger me-2"></i>Jakarta Utara</p>
                            <p class="card-text text-secondary small">Kawasan pesisir modern dengan pasir putih, jalur
                                sepeda, dan pusat kuliner luar ruangan yang trendi.</p>
                            <button onclick="moveToMarker(-6.0469, 106.7029)" class="btn btn-detail w-100 mt-2">Lihat di
                                Peta</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <footer class="py-5" style="background-color: var(--blue-dark);">
        <div class="container text-center text-white-50">
            <img src="assets/Logo1.png" style="height: 40px; margin-bottom: 20px; filter: brightness(0) invert(1);"
                alt="">
            <p class="mb-0">&copy; 2026 CoreJKT - Digital Tourism Jakarta.</p>
            <small>Sistem Informasi Navigasi & Wisata Terpadu</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inisialisasi Peta
        const map = L.map('map').setView([-6.1754, 106.8272], 12);

        // Tile Layer yang lebih modern (Voyager)
        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
            attribution: '© CARTO'
        }).addTo(map);

        // Data Destinasi
        const locations = [
            { name: "Kota Tua", coords: [-6.1352, 106.8133], desc: "Jakarta Barat" },
            { name: "TMII", coords: [-6.3024, 106.8952], desc: "Jakarta Timur" },
            { name: "M Bloc Space", coords: [-6.2430, 106.7982], desc: "Jakarta Selatan" },
            { name: "Monas", coords: [-6.1754, 106.8272], desc: "Jakarta Pusat" },
            { name: "Ancol", coords: [-6.1256, 106.8436], desc: "Jakarta Utara" },
            { name: "Galeri Nasional", coords: [-6.1783, 106.8327], desc: "Jakarta Pusat" },
            { name: "Taman Ismail Marzuki", coords: [-6.1901, 106.8373], desc: "Jakarta Pusat" },
            { name: "Kebun Binatang Ragunan", coords: [-6.3124, 106.8202], desc: "Jakarta Selatan" },
            { name: "Sarinah Thamrin", coords: [-6.1894, 106.8244], desc: "Jakarta Pusat" },
            { name: "Kuliner Jalan Sabang", coords: [-6.1856, 106.8247], desc: "Jakarta Pusat" },
            { name: "Hutan Kota GBK", coords: [-6.2238, 106.8064], desc: "Jakarta Pusat" },
            { name: "Museum MACAN", coords: [-6.1907, 106.7674], desc: "Jakarta Barat" },
            { name: "Pantai Indah Kapuk 2", coords: [-6.0469, 106.7029], desc: "Jakarta Utara" }
        ];

        // Tambahkan Marker ke Peta
        locations.forEach(loc => {
            L.marker(loc.coords).addTo(map)
                .bindPopup(`<b>${loc.name}</b><br>${loc.desc}`);
        });

        // Fungsi Fly-To untuk Interaktivitas Card
        function moveToMarker(lat, lng) {
            map.flyTo([lat, lng], 15, {
                animate: true,
                duration: 1.5
            });
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</body>

</html>