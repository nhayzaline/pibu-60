@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="mb-5">
    <h1 class="fw-bold text-white mb-0">Dashboard Admin</h1>
    <p class="text-white-50">Ringkasan data perpustakaan</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <a href="{{ route('admin.buku.create') }}" class="text-decoration-none h-100">
            <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px; transition: transform 0.2s;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <small class="text-muted small">Total Buku</small>
                        <h3 class="fw-bold mt-1 mb-1 text-dark">{{ number_format($totalBuku) }}</h3>
                        <small class="text-success" style="font-size: 11px;">+ Klik untuk tambah</small>
                    </div>
                    <i class="bi bi-book text-success fs-3"></i>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <small class="text-muted small">Total Anggota</small>
                    <h3 class="fw-bold mt-1 mb-1 text-dark">{{ number_format($totalAnggota) }}</h3>
                </div>
                <i class="bi bi-people text-danger fs-3"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <small class="text-muted small">Buku Dipinjam</small>
                    <h3 class="fw-bold mt-1 mb-1 text-dark">{{ number_format($bukuDipinjam) }}</h3>
                </div>
                <i class="bi bi-arrow-left-right text-warning fs-3"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 h-100" style="border-radius: 20px;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <small class="text-muted small">Tersedia</small>
                    <h3 class="fw-bold mt-1 mb-1 text-dark">{{ number_format($bukuTersedia) }}</h3>
                </div>
                <i class="bi bi-plus-lg text-success fs-3"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
            <h5 class="fw-bold mb-4">Peminjaman Terbaru</h5>
            <div class="list-group list-group-flush">
                @forelse($peminjamanTerbaru as $item)
                <div class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom px-0 py-3">
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">{{ $item->user->name ?? 'User' }}</h6>
                        <small class="text-muted">{{ $item->book->judul ?? 'Judul Buku' }}</small>
                    </div>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</small>
                </div>
                @empty
                <p class="text-muted small">Belum ada peminjaman.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
            <h5 class="fw-bold mb-4">Buku Terpopuler</h5>
            <div class="list-group list-group-flush">
                @forelse($bukuPopuler as $buku)
                <div class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom px-0 py-3">
                    <span class="text-dark">{{ $buku->judul }}</span>
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                        {{ $buku->detail_peminjamans_count ?? 0 }} Peminjam
                    </span>
                </div>
                @empty
                <p class="text-muted small">Data belum tersedia.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
