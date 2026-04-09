<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kembalikan Buku - PIBU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #79E0C1; font-family: 'Poppins', sans-serif; }
        .card-book { background: white; border-radius: 20px; border: none; padding: 25px; margin-bottom: 25px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .btn-kembali { background-color: #5BA48E; color: white; border-radius: 10px; padding: 8px 25px; border: none; font-weight: 500; transition: 0.3s; }
        .btn-kembali:hover { background-color: #4a8674; }
        .status-aman { color: #4CAF50; font-size: 14px; }
        .status-mendesak { background-color: #FFF9C4; color: #D4A017; padding: 10px; border-radius: 10px; text-align: center; font-weight: bold; width: 100%; margin-top: 15px; }
        .info-box { background-color: #C1F2E4; border-radius: 15px; border: 3px solid white; padding: 20px; color: #2D6A4F; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex align-items-center mb-5">
        <a href="{{ route('siswa.dashboard') }}" class="text-dark fs-3 me-3 text-decoration-none">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h2 class="fw-bold mb-0">Kembalikan Buku</h2>
            <small class="text-muted">Kelola pengembalian buku yang dipinjam</small>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            @forelse($pinjaman as $item)
<div class="card-book">
    <div class="d-flex justify-content-between align-items-start flex-wrap">
        <div>
            <h4 class="fw-bold mb-3">{{ $item->judul_buku }}</h4>
            <div class="text-muted mb-3" style="font-size: 14px;">
                Dipinjam: {{ $item->tgl_pinjam }}<br>
                Tenggat: {{ $item->tenggat_kembali }}
            </div>

            @if($item->status == 'Dipinjam')
                <div class="status-aman">
                    <i class="bi bi-check-circle-fill"></i> Status: Sedang Dipinjam
                </div>
            @endif
        </div>

        <form action="{{ route('siswa.prosesKembali', $item->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-kembali mt-2">Kembalikan Buku</button>
        </form>
    </div>
</div>
@empty
<div class="card-book text-center">
    <p class="text-muted">Kamu tidak memiliki tanggungan peminjaman buku.</p>
</div>
@endforelse

            <div class="info-box mt-5">
                <h6 class="fw-bold mb-3">Informasi Pengembalian :</h6>
                <ul class="mb-0 ps-3" style="font-size: 14px; line-height: 1.8;">
                    <li>Kembalikan buku ke petugas perpustakaan</li>
                    <li>Pastikan kondisi buku masih baik</li>
                    <li>Buku yang rusak akan dikenakan biaya perbaikan</li>
                    <li>Klik tombol "Kembalikan Buku" setelah menyerahkan ke petugas</li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>
