@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="mb-4">
            <h2 class="fw-bold">Manajemen Transaksi</h2>
            <p class="text-muted">Kelola data transaksi perpustakaan</p>
        </div>

        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
            <div class="card-body p-3">
                <div class="input-group border rounded-pill px-3 py-1">
                    <span class="input-group-text bg-transparent border-0"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control border-0 bg-transparent"
                        placeholder="Cari judul, penulis, atau ISBN...">
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="table-responsive p-4">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Peminjam</th>
                            <th>NIS</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                            <tr>
                                <td>{{ $trx->user->name }}</td>
                                <td>{{ $trx->user->nis ?? '-' }}</td>
                                <td>{{ $trx->book->judul }}</td>
                                <td>{{ $trx->tanggal_pinjam }}</td>
                                <td>
                                    <span class="badge {{ $trx->status == 'kembali' ? 'bg-success' : 'bg-warning' }}">
                                        {{ strtoupper($trx->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary border-0"><i
                                            class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Belum ada data transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
