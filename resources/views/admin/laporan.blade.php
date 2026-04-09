@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4" style="background-color: #7FE5C4; min-height: 100vh;">

    <div class="mb-4">
        <h2 class="fw-bold">Laporan Perpustakaan</h2>
        <p class="text-muted">Statistik dan ringkasan aktivitas</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Peminjaman Bulan Ini</p>
                        <h2 class="fw-bold mb-0">{{ $pinjamBulanIni }}</h2>
                        <small class="text-success"></small>
                    </div>
                    <i class="bi bi-arrow-left-right text-warning fs-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Buku Dipinjam</p>
                        <h2 class="fw-bold mb-0">{{ $bukuSedangDipinjam }}</h2>
                    </div>
                    <i class="bi bi-book text-success fs-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Anggota Aktif</p>
                        <h2 class="fw-bold mb-0">{{ $anggotaAktif }}</h2>
                        <small class="text-success"></small>
                    </div>
                    <i class="bi bi-people text-dark fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4">Peminjaman Terbaru</h5>
                @foreach($peminjamanTerbaru as $p)
                    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $p->user->name }}</h6>
                            <small class="text-muted">{{ $p->book->judul }}</small>
                        </div>
                        <small class="text-muted">{{ $p->created_at->format('d M Y') }}</small>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
                <h5 class="fw-bold mb-4">Buku Terpopuler</h5>
                @foreach($bukuPopuler as $b)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="mb-0">{{ $b->judul }}</p>
                        <span class="badge bg-primary rounded-pill px-3">{{ $b->detail_peminjamans_count }} Peminjam</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
