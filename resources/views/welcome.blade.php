<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIBU - Sistem Pinjam Buku Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #79E0C1; color: #333; overflow-x: hidden; }
        .navbar { background-color: white !important; padding: 0.8rem 5%; }
        .hero-section { padding: 100px 5% 50px; min-height: 90vh; display: flex; align-items: center; }

        /* Memperbaiki tampilan teks Hero sesuai desain */
        .hero-title { font-size: 3.5rem; font-weight: 800; line-height: 1.1; color: #1a1a1a; }
        .hero-subtitle { font-size: 1.1rem; margin: 25px 0; color: #444; max-width: 550px; }

        /* Button Custom untuk Sign as admin/siswa */
        .btn-custom {
            padding: 12px 25px; border-radius: 15px; font-weight: 600; transition: 0.3s;
            border: none; background: rgba(255, 255, 255, 0.5); color: #1e4d40; text-decoration: none;
        }
        .btn-custom:hover { background: white; transform: translateY(-3px); color: #1e4d40; }

        .book-card img { transition: 0.3s; aspect-ratio: 2/3; object-fit: cover; width: 100%; }
        .book-card img:hover { transform: scale(1.05); box-shadow: 0 15px 30px rgba(0,0,0,0.2) !important; }

        html { scroll-behavior: smooth; }
        section { scroll-margin-top: 80px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <img src="{{ asset('images/LOGO_PIBU.png') }}" width="40" class="me-2">
            <div>
                <span class="d-block lh-1">Pinjam Buku</span>
                <small class="fw-normal text-muted d-block" style="font-size: 0.7rem;">Sistem Pinjam Buku Digital</small>
            </div>
        </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item ms-lg-3">
                    <a href="{{ route('login') }}" class="btn px-4 rounded-pill fw-bold"
                       style="background-color: #79E0C1; color: #1e4d40; border: none;">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="beranda" class="hero-section">
    <div class="container">
        <div class="row align-items-center text-start">
            <div class="col-lg-6">
                <section id="beranda" class="py-5" style="background-color: #79E0C1;">
                    <h1 class="text-secondary opacity-75">Selamat datang di <span class="fw-bold text-dark">PIBU</span></h1>
                    <h1 class="fw-bold">Platform Buku Online <br> yang <span style="color: #2D6A4F;">Menyenangkan!</span></h1>
                    <p class="hero-subtitle">
                        Temukan ribuan buku menarik dan bermanfaat untuk semua.
                        Bergabung dengan komunitas PIBU dan asiknya membaca.
                    </p>

                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('login', ['role' => 'admin']) }}" class="btn-custom shadow-sm">Sign as admin</a>
                    <span class="fw-bold text-white fs-4">/</span>
                    <a href="{{ route('login', ['role' => 'siswa']) }}" class="btn-custom shadow-sm">Sign as siswa</a>
                </div>
            </div>

            <div class="col-lg-6 text-center mt-5 mt-lg-0">
                <img src="{{ asset('images/beranda.png') }}" alt="Ilustrasi" class="img-fluid" style="max-height: 450px;">
            </div>
        </div>
    </div>
</section>

<section id="tentang" class="py-5" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 pe-lg-5">
                <p class="fs-4 lh-base text-dark" style="text-align: justify;">
                    <span class="fw-bold">Pibu</span> adalah website platform buku digital yang membantu siswa mengakses dan membaca buku secara online dengan mudah dan cepat.
                    Mendukung kegiatan literasi dan modernisasi perpustakaan.
                </p>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/pohon.png') }}" class="img-fluid" style="max-width: 80%;">
            </div>
        </div>
    </div>
</section>

<footer class="py-4 text-center border-top">
    <p class="mb-0 text-dark-50 fw-bold">&copy; 2026 PIBU - Pinjam buku, gak pakai kaku.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
