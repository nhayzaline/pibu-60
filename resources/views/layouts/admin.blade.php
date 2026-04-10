<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PIBU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .sidebar {
            width: 280px;
            height: 100vh;
            background: white;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
        }

        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            background-color: #79E0C1;
            padding: 40px;
        }

        .nav-link {
            color: #333;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 10px;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #f8f9fa;
            color: #2D6A4F;
            font-weight: bold;
        }

        .stat-card {
            border-radius: 15px;
            border: none;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar shadow-sm">
        <div class="d-flex align-items-center mb-5 px-4">
            <img src="{{ asset('images/LOGO_PIBU.png') }}" width="40" class="me-2">
            <div>
                <h6 class="fw-bold mb-0">Pinjam Buku</h6>
                <small class="text-muted" style="font-size: 10px;">Sistem Pinjam Buku Digital</small>
            </div>
        </div>
        <div class="nav flex-column px-3">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.anggota') }}"
                class="nav-link {{ request()->is('admin/anggota') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Anggota
            </a>
            <a href="{{ route('admin.transaksi') }}"
                class="nav-link {{ request()->is('admin/transaksi') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Transaksi
            </a>
            <a href="{{ route('admin.laporan') }}"
                class="nav-link {{ request()->is('admin/laporan') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Laporan
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-end mb-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-white shadow-sm rounded-pill px-4 fw-bold">
                    <i class="bi bi-box-arrow-right me-2"></i> Log Out
                </button>
            </form>
        </div>
        @yield('content')
    </div>
</body>

</html>
