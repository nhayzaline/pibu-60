<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - PIBU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #79E0C1; font-family: 'Poppins', sans-serif; }
        .stat-card { background: white; border-radius: 15px; padding: 20px; border: none; height: 100%; }
        .stat-value { font-size: 2rem; font-weight: bold; margin-bottom: 0; }
        .search-container { background: white; border-radius: 15px; padding: 15px; margin-top: 30px; }
        .btn-filter { border-radius: 8px; padding: 5px 20px; border: 1px solid #5BA48E; color: #5BA48E; background: white; font-weight: 500; }
        .btn-filter.active { background: #5BA48E; color: white; }
        .history-card { background: white; border-radius: 15px; padding: 25px; border: none; margin-bottom: 20px; position: relative; }
        .badge-tepat { background-color: #D1FAE5; color: #059669; }
        .badge-lambat { background-color: #FEE2E2; color: #DC2626; }
        .info-label { font-size: 0.8rem; color: #9CA3AF; margin-bottom: 2px; }
        .info-value { font-size: 0.9rem; font-weight: 500; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('siswa.dashboard') }}" class="text-dark fs-3 me-3"><i class="bi bi-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold mb-0">Riwayat Peminjaman</h2>
            <small class="text-muted">Lihat semua aktivitas peminjaman</small>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="stat-card shadow-sm d-flex justify-content-between align-items-center">
                <div><p class="text-muted small mb-1">Total Pinjam</p><p class="stat-value">{{ $stats['total'] }}</p></div>
                <i class="bi bi-clock-history fs-3 text-secondary"></i>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="stat-card shadow-sm d-flex justify-content-between align-items-center">
                <div><p class="text-muted small mb-1">Tepat Waktu</p><p class="stat-value text-success">{{ $stats['tepat_waktu'] }}</p></div>
                <i class="bi bi-check-circle fs-3 text-success"></i>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="stat-card shadow-sm d-flex justify-content-between align-items-center">
                <div><p class="text-muted small mb-1">Terlambat</p><p class="stat-value text-danger">{{ $stats['terlambat'] }}</p></div>
                <i class="bi bi-x-circle fs-3 text-danger"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card shadow-sm d-flex justify-content-between align-items-center">
                <div><p class="text-muted small mb-1">Total Denda</p><p class="stat-value">{{ $stats['denda'] }}</p></div>
                <i class="bi bi-calendar-event fs-3 text-danger"></i>
            </div>
        </div>
    </div>

    <div class="search-container shadow-sm">
        <div class="input-group mb-3 border-bottom pb-2">
            <span class="input-group-text bg-transparent border-0"><i class="bi bi-search"></i></span>
            <input type="text" id="search-riwayat" class="form-control border-0" placeholder="Cari Judul, Penulis, atau ISBN.....">
        </div>
        <div class="d-flex gap-2 mt-2">
            <button class="btn-filter active" onclick="filterStatus('Semua')">Semua</button>
            <button class="btn-filter" onclick="filterStatus('Tepat Waktu')">Tepat Waktu</button>
            <button class="btn-filter" onclick="filterStatus('Terlambat')">Terlambat</button>
        </div>
    </div>

    <div class="mt-4">
    @forelse($dataRiwayat as $item)
    <div class="history-card shadow-sm card-riwayat" data-status="{{ $item->status }}">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h4 class="fw-bold mb-0 judul-buku">{{ $item->judul_buku }}</h4>
            <span class="badge {{ $item->status == 'Tepat Waktu' ? 'badge-tepat' : 'badge-lambat' }} px-3 py-2">
                {{ $item->status }}
            </span>
        </div>
        <div class="row text-center text-md-start">
            <div class="col-md-4">
                <p class="info-label">Tanggal Pinjam</p>
                <p class="info-value">{{ $item->tgl_pinjam }}</p>
            </div>
            <div class="col-md-4 border-start border-end">
                <p class="info-label">Tenggat Kembali</p>
                <p class="info-value">{{ $item->tenggat_kembali }}</p>
            </div>
            <div class="col-md-4">
                <p class="info-label">Terakhir Update</p>
                <p class="info-value">{{ $item->updated_at->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="history-card shadow-sm text-center">
        <p class="text-muted">Belum ada riwayat peminjaman.</p>
    </div>
    @endforelse
</div>
</div>

<script>
    // Fitur Cari Real-time
    document.getElementById('search-riwayat').addEventListener('keyup', function() {
        let text = this.value.toLowerCase();
        document.querySelectorAll('.card-riwayat').forEach(card => {
            let judul = card.querySelector('.judul-buku').innerText.toLowerCase();
            card.style.display = judul.includes(text) ? "block" : "none";
        });
    });

    // Fitur Filter Status
    function filterStatus(status) {
        // Update styling tombol
        document.querySelectorAll('.btn-filter').forEach(btn => {
            btn.classList.toggle('active', btn.innerText === status);
        });

        // Filter kartu
        document.querySelectorAll('.card-riwayat').forEach(card => {
            let cardStatus = card.getAttribute('data-status');
            card.style.display = (status === 'Semua' || cardStatus === status) ? "block" : "none";
        });
    }
</script>

</body>
</html>
