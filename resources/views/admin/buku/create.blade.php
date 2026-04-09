@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('admin.dashboard') }}" class="text-dark me-3">
            <i class="bi bi-arrow-left fs-2"></i>
        </a>
        <div>
            <h2 class="fw-bold mb-0">Tambah Buku</h2>
            <p class="text-muted mb-0">Penambahan Buku baru</p>
        </div>
    </div>

    <div class="card border-0 shadow-lg p-5" style="border-radius: 20px;">
        <form action="{{ route('admin.buku.store') }}" method="POST">
            @csrf
            <div class="row g-4 text-start">
                <div class="col-md-6">
                    <label class="fw-bold mb-2">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul..." required>

                    <label class="fw-bold mt-4 mb-2">Penulis/Pencipta</label>
                    <input type="text" name="penulis" class="form-control" placeholder="Nama penulis..." required>

                    <label class="fw-bold mt-4 mb-2">ISBN</label>
                    <input type="text" name="ISBN" class="form-control" placeholder="Nomor ISBN..." required>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold mb-2">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" class="form-control" placeholder="Contoh: 2024" required>

                    <label class="fw-bold mt-4 mb-2">Jumlah Stok</label>
                    <input type="number" name="stok" class="form-control" placeholder="Contoh: 50" required>

                    <label class="fw-bold mt-4 mb-2">Kategori</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="1">Fiksi</option>
                    </select>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn border-0 shadow-sm fw-bold px-5 py-2" style="background-color: #7FE5D1; border-radius: 10px;">
                    TAMBAHKAN KE STOK BUKU
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
