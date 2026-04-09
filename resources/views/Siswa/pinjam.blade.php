<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku - PIBU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body { background-color: #79E0C1; font-family: 'Poppins', sans-serif; }
        .main-card { background: white; border-radius: 20px; border: none; padding: 30px; }
        .side-card { background: white; border-radius: 20px; border: none; padding: 25px; margin-bottom: 20px; }
        .info-banner { background-color: #C1F2E4; border-radius: 10px; padding: 15px; display: flex; align-items: center; margin-bottom: 25px; }
        .form-control, .form-select { border-radius: 10px; background-color: #F3F3F3; border: none; padding: 12px; }
        .btn-submit { background-color: #2D6A4F; color: white; border-radius: 10px; padding: 12px; border: none; font-weight: bold; width: 100%; transition: 0.3s; }
        .btn-submit:hover { background-color: #1b4332; }
        .btn-back { border: 2px solid #2D6A4F; color: #2D6A4F; border-radius: 10px; padding: 12px; font-weight: bold; text-decoration: none; display: inline-block; width: 100%; text-align: center; }
        .progress-custom { height: 10px; border-radius: 5px; background-color: #E0E0E0; }
        .progress-bar-custom { background-color: #4CAF50; border-radius: 5px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('siswa.dashboard') }}" class="text-dark fs-3 me-3"><i class="bi bi-arrow-left"></i></a>
        <div>
            <h2 class="fw-bold mb-0">Pinjam Buku</h2>
            <small class="text-muted">Ajukan peminjaman buku perpustakaan</small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="main-card shadow-sm">
                <div class="info-banner">
                    <i class="bi bi-journal-text fs-4 me-3 text-success"></i>
                    <div>
                        <strong class="d-block">Informasi Peminjaman</strong>
                        <small class="text-muted" style="font-size: 10px;">Durasi peminjaman: 14 hari • Maksimal 3 buku per siswa</small>
                    </div>
                </div>

                <form action="{{ route('siswa.ajukanPinjam') }}" method="POST" id="formPinjam">
                    @csrf
                    <div class="mb-3">
                        <label class="fw-bold mb-2">Cari Buku</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Cari judul buku.....">
                        </div>
                    </div>

                   <div class="mb-3">
    <label class="fw-bold mb-2">Judul Buku</label>
    @if(isset($judulDipilih) && $judulDipilih)
        <input type="text" name="judul_buku" class="form-control bg-light"
               value="{{ $judulDipilih }}" readonly required>
        <small class="text-success" style="font-size: 11px;">
            <i class="bi bi-info-circle"></i> Buku dipilih otomatis dari menu Cari.
        </small>
    @else
        <select id="bookSelect" name="judul_buku" class="form-select" required>
            <option value="" selected disabled>Pilih buku yang tersedia.....</option>
            <option value="Fisika Kelas X">Fisika Kelas X</option>
            <option value="Matematika Dasar">Matematika Dasar</option>
            <option value="Biologi Dasar">Biologi Dasar</option>
            <option value="Kimia Organik">Kimia Organik</option>
            <option value="Seporsi Mie Ayam Sebelum Mati">Seporsi Mie Ayam Sebelum Mati</option>
        </select>
    @endif
</div>

                    <div class="row mb-4">
                        <div class="col-6">
                            <label class="fw-bold mb-2">Tanggal Pinjam</label>
                            <input type="date" class="form-control" name="tgl_pinjam" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-6">
                            <label class="fw-bold mb-2">Tanggal kembali</label>
                            <input type="date" class="form-control" name="tenggat_kembali" value="{{ date('Y-m-d', strtotime('+14 days')) }}">
                        </div>
                    </div>

                    <div class="alert alert-warning border-0" style="background-color: #FFF9C4; border-radius: 10px;">
                        <small class="fw-bold text-warning d-block mb-1">Perhatian :</small>
                        <ul class="mb-0 ps-3" style="font-size: 11px;">
                            <li>Kembalikan buku tepat waktu untuk menghindari denda</li>
                            <li>Denda keterlambatan: Rp 1.000 per hari</li>
                            <li>Jaga kondisi buku dengan baik</li>
                        </ul>
                    </div>

                    <div class="row g-2 mt-4">
                        <div class="col-9">
                            <button type="submit" class="btn btn-submit"><i class="bi bi-journal-bookmark-fill me-2"></i> Ajukan Peminjaman</button>
                        </div>
                        <div class="col-3">
                            <a href="{{ route('siswa.dashboard') }}" class="btn-back">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="side-card shadow-sm">
                <h5 class="fw-bold mb-4">Status Peminjaman</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Sedang Dipinjam</span>
                    <span class="fw-bold">2/3</span>
                </div>
                <div class="progress progress-custom mb-3">
                    <div class="progress-bar progress-bar-custom" style="width: 66%;"></div>
                </div>
                <small class="text-muted">Kamu masih bisa meminjam satu buku lagi</small>
            </div>

            <div class="side-card shadow-sm">
                <h5 class="fw-bold mb-4">Buku Populer</h5>
                <ol class="ps-3">
                    @foreach($bukuPopuler as $item)
                        <li class="mb-2 fw-bold">{{ $item }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Fitur 1: Pencarian Buku Real-time
    document.getElementById('searchInput').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let options = document.querySelectorAll('#bookSelect option');

        options.forEach(option => {
            if(option.disabled) return;
            let text = option.text.toLowerCase();

            if (text.includes(filter)) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
                if(option.selected) document.getElementById('bookSelect').value = "";
            }
        });
    });

    // Fitur 2: Pop-up Berhasil (SweetAlert)
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#2D6A4F',
            confirmButtonText: 'Oke'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('siswa.dashboard') }}";
            }
        });
    @endif
</script>

</body>
</html>
