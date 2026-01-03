<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Architect - CoreJKT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Plus+Jakarta+Sans:wght@300;400;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --gold: #ffc107;
            --cyan: #00d2ff;
            --deep: #051025;
        }

        body {
            background: radial-gradient(circle at center, #1a2a44 0%, #051025 100%);
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #stars-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: url('https://www.transparenttextures.com/patterns/stardust.png');
            opacity: 0.3;
        }

        .creator-title {
            font-family: 'Cinzel', serif;
            font-size: 3rem;
            letter-spacing: 10px;
            text-shadow: 0 0 20px var(--cyan);
            margin-top: 80px;
            margin-bottom: 50px;
            animation: fadeInDown 1.5s ease;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 30px 20px;
            text-align: center;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .glass-card:hover {
            transform: translateY(-20px) scale(1.05);
            border-color: var(--cyan);
            box-shadow: 0 20px 50px rgba(0, 210, 255, 0.3);
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid var(--gold);
            padding: 5px;
            margin-bottom: 20px;
            object-fit: cover;
            box-shadow: 0 0 20px var(--gold);
        }

        .name-tag {
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--gold);
            margin-bottom: 5px;
        }

        .role-tag {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: 0.7;
            margin-bottom: 15px;
            display: block;
        }

        /* GALLERY FRAME STYLING */
        .gallery-container {
            margin-top: 100px;
            margin-bottom: 100px;
            width: 100%;
            max-width: 1000px;
            padding: 20px;
            animation: fadeInUp 2s ease;
        }

        .gallery-frame {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 2px solid var(--gold);
            border-radius: 40px;
            padding: 40px;
            position: relative;
            box-shadow: 0 0 40px rgba(255, 193, 7, 0.2);
        }

        .gallery-frame::before {
            content: "TEAM MEMORIES";
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--gold);
            color: var(--deep);
            padding: 5px 25px;
            border-radius: 50px;
            font-weight: 900;
            font-size: 0.8rem;
            letter-spacing: 3px;
        }

        .carousel-item img {
            height: 500px;
            object-fit: cover;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .social-links a {
            color: white;
            margin: 0 8px;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .social-links a:hover {
            color: var(--cyan);
            transform: scale(1.3);
        }

        .btn-back {
            position: fixed;
            top: 30px;
            left: 30px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            text-decoration: none;
            backdrop-filter: blur(10px);
            transition: 0.3s;
            z-index: 100;
        }

        .btn-back:hover {
            background: var(--cyan);
            color: var(--deep);
            font-weight: bold;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div id="stars-container"></div>

    <a href="javascript:history.back()" class="btn-back">
        <i class="fas fa-arrow-left me-2"></i> Kembali ke Realita
    </a>

    <div class="container py-5 text-center">
        <h1 class="creator-title">THE ARCHITECTS</h1>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6">
                <div class="glass-card">
                    <img src="https://ui-avatars.com/api/?name=Najwa+Khairun&background=random&size=200"
                        class="profile-img" alt="Kreator 1">
                    <div class="name-tag">Najwa Khairun Nisa</div>
                    <span class="role-tag">Project Manager</span>
                    <p class="small opacity-75">"Membangun masa depan Jakarta melalui baris kode yang presisi."</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fab fa-github"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="glass-card" style="animation-delay: 0.2s;">
                    <img src="https://ui-avatars.com/api/?name=Nadhif+Pramudya&background=random&size=200"
                        class="profile-img" alt="Kreator 2">
                    <div class="name-tag">Nadhif Pramudya</div>
                    <span class="role-tag">Full Stack Developer</span>
                    <p class="small opacity-75">"Mengharmonisasikan estetika dengan fungsionalitas digital."</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fab fa-behance"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="glass-card" style="animation-delay: 0.4s;">
                    <img src="https://ui-avatars.com/api/?name=Jawara+Kadi&background=random&size=200"
                        class="profile-img" alt="Kreator 3">
                    <div class="name-tag">Jawara K.Adi Guna</div>
                    <span class="role-tag">System Architect</span>
                    <p class="small opacity-75">"Menyusun pondasi sistem yang kokoh dan terintegrasi."</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fas fa-network-wired"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="glass-card" style="animation-delay: 0.6s;">
                    <img src="https://ui-avatars.com/api/?name=Haykal+Maulana&background=random&size=200"
                        class="profile-img" alt="Kreator 4">
                    <div class="name-tag">Haykal Maulana A.L</div>
                    <span class="role-tag">Engineer</span>
                    <p class="small opacity-75">"Mengolah data menjadi informasi yang cerdas untuk warga."</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fas fa-database"></i></a>
                        <a href="#"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="gallery-container mx-auto">
            <div class="gallery-frame">
                <div id="teamCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#teamCarousel" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/CoreTeam.jpeg"
                                class="d-block w-100" alt="Tim Photo 1">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="fw-bold">The Creative Minds</h5>
                                <p>Sesi brainstorming peluncuran CoreJKT.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?q=80&w=2070&auto=format&fit=crop"
                                class="d-block w-100" alt="Tim Photo 2">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="fw-bold">Late Night Coding</h5>
                                <p>Komitmen penuh untuk Jakarta Kota Global.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?q=80&w=2070&auto=format&fit=crop"
                                class="d-block w-100" alt="Tim Photo 3">
                            <div class="carousel-caption d-none d-md-block">
                                <h5 class="fw-bold">One Solid Squad</h5>
                                <p>Bersama mewujudkan integrasi layanan publik.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-5 opacity-50 small">
            &copy; 2026 CoreJKT Elite Squad. Created with Passion & Coffee.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>