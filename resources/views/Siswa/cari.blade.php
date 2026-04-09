<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Buku - PIBU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #79E0C1; font-family: 'Poppins', sans-serif; }
        .search-container { background: white; border-radius: 15px; padding: 10px 25px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .search-input { border: 2px solid #E0E0E0; border-radius: 10px; padding: 12px 20px; width: 100%; outline: none; }
        .book-card { background: white; border-radius: 20px; border: none; padding: 20px; margin-bottom: 20px; position: relative; transition: 0.3s; }
        .book-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .book-icon { width: 80px; height: 100px; background-color: #79E0C1; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 40px; }
        .category-badge { background-color: #E3F2FD; color: #2196F3; border-radius: 5px; padding: 2px 10px; font-size: 10px; font-weight: bold; }
        .stock-badge { background-color: #C8E6C9; color: #2E7D32; border-radius: 5px; padding: 2px 10px; font-size: 10px; font-weight: bold; }
        .sidebar-card { background: white; border-radius: 20px; padding: 0; overflow: hidden; }
        .sidebar-header { padding: 20px; border-bottom: 1px solid #F0F0F0; font-weight: bold; }
        .sidebar-item { padding: 15px 25px; border-bottom: 1px solid #F0F0F0; cursor: pointer; transition: 0.3s; }
        .sidebar-item:hover, .sidebar-item.active { background-color: #F8F9FA; color: #2D6A4F; font-weight: bold; }

        /* Modal Styling Sesuai Figma */
        .modal-content { border-radius: 20px; border: none; overflow: hidden; }
        .modal-body h6 { letter-spacing: 1px; color: #333; font-weight: bold; text-transform: uppercase; font-size: 12px; }
        .modal-left-panel { background-color: #79E0C1; display: flex; align-items: center; justify-content: center; p: 4; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('siswa.dashboard') }}" class="text-dark fs-3 me-3 text-decoration-none"><i class="bi bi-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold mb-0">Cari Buku</h2>
            <small class="text-muted">Jelajahi koleksi perpustakaan</small>
        </div>
    </div>

    <div class="search-container">
        <div class="d-flex align-items-center">
            <i class="bi bi-search fs-4 me-3 text-muted"></i>
            <input type="text" id="search-input" class="search-input border-0" placeholder="Cari Judul, Penulis, atau ISBN.....">
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <small class="text-muted d-block mb-3">Ditemukan <span id="count-buku">{{ count($koleksiBuku) }}</span> Buku</small>
            <div id="container-buku">
                @foreach($koleksiBuku as $buku)
                <div class="book-card shadow-sm item-buku" data-category="{{ $buku['kategori'] }}">
                    <div class="d-flex align-items-center">
                        <div class="book-icon me-4"><i class="bi bi-book"></i></div>
                        <div class="flex-grow-1 text-start">
                            <h5 class="fw-bold mb-1">{{ $buku['judul'] }}</h5>
                            <small class="text-muted d-block mb-1">{{ $buku['penulis'] }}</small>
                            <div class="d-flex gap-2 align-items-center mt-2">
                                <span class="category-badge">{{ $buku['kategori'] }}</span>
                                <span class="stock-badge">{{ $buku['stok'] }}</span>
                                <small class="text-muted isbn-text" style="font-size: 10px;">ISBN: {{ $buku['isbn'] ?? 'N/A' }}</small>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <button class="btn btn-outline-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $loop->iteration }}">
                                Detail
                            </button>
                            <a href="{{ route('siswa.pinjam', ['judul' => $buku['judul']]) }}" class="btn btn-warning btn-sm text-white">
                                Pinjam
                            </a>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="detailModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-body p-0 text-start">
                                <div class="row g-0">
                                    <div class="col-md-5 p-5 modal-left-panel">
                                        <div class="col-md-5 p-5 modal-left-panel" style="background-color: #79E0C1;">
                                            @if(isset($buku['cover']) && $buku['cover'] != '')
                                                <img src="{{ asset('storage/' . $buku['cover']) }}"
                                                class="img-fluid shadow-lg rounded"
                                                alt="Cover {{ $buku['judul'] }}"
                                                style="max-height: 400px; object-fit: cover;">
                                            @else
                                            <div class="bg-white p-4 rounded shadow-sm d-flex flex-column align-items-center justify-content-center" style="width: 200px; height: 300px;">
                                                <i class="bi bi-book text-success" style="font-size: 5rem;"></i>
                                                <small class="text-muted mt-2">No Cover</small>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-7 p-4 position-relative">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>

                                        <h5 class="text-success fw-bold mb-1">Detail Buku</h5>
                                        <h2 class="fw-bold mb-0">{{ $buku['judul'] }}</h2>
                                        <p class="text-muted">Oleh : {{ $buku['penulis'] }}</p>

                                        <div class="mb-4">
                                            <span class="text-warning"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i></span>
                                            <span class="ms-2 fw-bold">4.0</span>
                                            <span class="ms-2 text-muted small">(120 Kali dipinjam)</span>
                                        </div>

                                        <h6>Sinopsis</h6>
                                        <p class="text-muted small mb-4" style="text-align: justify;">
                                            {{ $buku['sinopsis'] ?? 'Sinopsis tidak tersedia untuk buku ini. Silakan hubungi petugas perpustakaan untuk informasi lebih lanjut mengenai konten buku.' }}
                                        </p>

                                        <h6>Spesifikasi</h6>
                                        <div class="row g-2 mt-1">
                                            <div class="col-6"><small class="text-muted d-block">ISBN</small><span class="fw-bold small">{{ $buku['isbn'] ?? '-' }}</span></div>
                                            <div class="col-6"><small class="text-muted d-block">Penerbit</small><span class="fw-bold small">Pustaka Utama</span></div>
                                            <div class="col-6"><small class="text-muted d-block">Kategori</small><span class="fw-bold small">{{ $buku['kategori'] }}</span></div>
                                            <div class="col-6"><small class="text-muted d-block">Tahun</small><span class="fw-bold small">2023</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4">
            <div class="sidebar-card shadow-sm">
                <div class="sidebar-header d-flex justify-content-between align-items-center">
                    Fitur Cepat
                    <button class="btn btn-sm btn-link text-decoration-none p-0 text-success fw-bold" onclick="filterBuku('all')">Reset</button>
                </div>
                @foreach($fiturCepat as $kategori)
                    <div class="sidebar-item btn-filter" onclick="filterBuku('{{ $kategori }}')">
                        {{ $kategori }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Fungsi Filter Kategori
    function filterBuku(kategori) {
        const searchInput = document.getElementById('search-input');
        if(searchInput) searchInput.value = "";
        const items = document.querySelectorAll('.item-buku');
        let count = 0;

        items.forEach(item => {
            const itemCat = item.getAttribute('data-category');
            if (kategori === 'all' || itemCat === kategori) {
                item.style.display = 'block';
                count++;
            } else {
                item.style.display = 'none';
            }
        });
        document.getElementById('count-buku').innerText = count;
    }

    // Fungsi Pencarian Real-time
    document.getElementById('search-input').addEventListener('keyup', function() {
        let searchText = this.value.toLowerCase();
        let bookCards = document.querySelectorAll('.item-buku');
        let visibleCount = 0;

        bookCards.forEach(card => {
            let title = card.querySelector('h5').innerText.toLowerCase();
            let author = card.querySelector('small').innerText.toLowerCase();
            if (title.includes(searchText) || author.includes(searchText)) {
                card.style.display = "block";
                visibleCount++;
            } else {
                card.style.display = "none";
            }
        });
        document.getElementById('count-buku').innerText = visibleCount;
    });
</script>

</body>
</html>
