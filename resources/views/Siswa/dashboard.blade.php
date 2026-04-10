<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - PIBU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #79E0C1; font-family: 'Poppins', sans-serif; }
        .navbar-custom { background: white; border-radius: 0 0 20px 20px; }
        .nav-card {
            background: white; border-radius: 25px; border: none; transition: 0.3s;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05); text-align: left; padding: 25px;
        }
        .nav-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .icon-box {
            width: 50px; height: 50px; border-radius: 12px; display: flex;
            align-items: center; justify-content: center; margin-bottom: 15px;
        }
        .bg-green { background-color: #2D6A4F; color: white; }
        .bg-orange { background-color: #FB8C00; color: white; }
        .bg-blue { background-color: #4285F4; color: white; }
        .bg-black { background-color: #1a1a1a; color: white; }

        .list-section { background: white; border-radius: 25px; padding: 30px; min-height: 400px; }
        .logout-btn { border: 2px solid #2D6A4F; border-radius: 12px; color: #2D6A4F; font-weight: bold; }
    </style>
</head>
<body>

<nav class="navbar navbar-light navbar-custom py-3 px-4 mb-5">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/LOGO_PIBU.png') }}" width="40" class="me-2">
            <div>
                <span class="fw-bold d-block lh-1">Pinjam Buku</span>
                <small class="text-muted">Sistem Pinjam Buku Digital</small>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn logout-btn px-4">
                <i class="bi bi-box-arrow-right"></i> Log Out
            </button>
        </form>
    </div>
</nav>

<div class="container text-center">
    <h1 class="fw-bold mb-1">Selamat Datang, {{ auth()->user()->name }}!</h1>
    <p class="text-dark mb-5">Apa yang mau kamu lakukan hari ini?</p>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
        <a href="{{ route('siswa.pinjam') }}" class="text-decoration-none text-dark">
            <div class="nav-card">
                <div class="icon-box bg-green"><i class="bi bi-bookmark-fill fs-4"></i></div>
                <h5 class="fw-bold mb-1">Pinjam Buku</h5>
                <small class="text-muted">Ajukan Pinjam Buku Baru</small>
            </div>
        </a>
    </div>
        <div class="col-md-3">
            <a href="{{ route('siswa.kembali') }}" class="text-decoration-none text-dark">
                <div class="nav-card">
                <div class="icon-box bg-orange"><i class="bi bi-arrow-left-circle-fill fs-4"></i></div>
                    <h5 class="fw-bold mb-1">Kembalikan Buku</h5>
                    <small class="text-muted">Kembalikan buku yang dipinjam</small>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('siswa.cari') }}" class="text-decoration-none text-dark">
            <div class="nav-card">
                <div class="icon-box bg-blue"><i class="bi bi-search fs-4"></i></div>
                <h5 class="fw-bold mb-1">Cari Buku</h5>
                <small class="text-muted">Cari koleksi buku pinjaman</small>
            </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('siswa.riwayat') }}" class="text-decoration-none text-dark">
            <div class="nav-card">
                <div class="icon-box bg-black"><i class="bi bi-clock-history fs-4"></i></div>
                <h5 class="fw-bold mb-1">Riwayat</h5>
                <small class="text-muted">Lihat riwayat peminjaman</small>
            </div>
            </a>
        </div>
    </div>

    <div class="row g-4 text-start">
        <div class="col-md-6">
            <div class="list-section shadow-sm">
    <h5 class="fw-bold mb-1">Peminjaman Aktif</h5>
    <p class="text-muted small mb-4">Buku yang sedang dipinjam</p>
    <hr>

    @forelse($peminjamanAktif as $item)
        <div class="py-3">
            <h6 class="fw-bold mb-1">{{ $item->judul_buku }}</h6>
            <small class="text-muted">Tanggal : {{ $item->tgl_pinjam }}</small>
        </div>
        <hr>
    @empty
        <div class="py-3 text-center">
            <p class="text-muted small">Belum ada peminjaman aktif.</p>
        </div>
    @endforelse
</div>
        </div>
        <div class="col-md-6">
            <div class="list-section shadow-sm">
                <h5 class="fw-bold mb-1">Rekomendasi Buku</h5>
                <p class="text-muted small mb-4">Buku populer minggu ini</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div>
                        <h6 class="fw-bold mb-0">Kimia Organik</h6>
                        <small class="text-muted">Sains</small>
                    </div>
                    <span class="badge bg-light text-success">5 tersedia</span>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
