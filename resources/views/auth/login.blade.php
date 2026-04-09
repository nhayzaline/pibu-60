<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PIBU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #79E0C1; height: 100vh; display: flex; align-items: center; font-family: 'Poppins', sans-serif; }
        .login-card { border-radius: 40px; border: none; width: 450px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }

        /* State Tombol Role sesuai Figma */
        .btn-role { border-radius: 15px; border: 1px solid #eee; transition: 0.3s; color: #666; background-color: #fff; }
        .btn-role.active { background-color: #79E0C1 !important; color: #1e4d40 !important; border: none; font-weight: bold; }

        .form-control { border-radius: 20px; border: 2px solid #f0f0f0; padding: 12px 20px; }
        .form-control:focus { border-color: #79E0C1; box-shadow: none; }

        .btn-login { background-color: #79E0C1; color: #1e4d40; border-radius: 20px; font-weight: bold; border: none; transition: 0.3s; padding: 10px; }
        .btn-login:hover { background-color: #62c9ab; transform: translateY(-2px); }
    </style>
</head>
<body>

@php
    // Menangkap role dari tombol Landing Page
    // Jika tidak ada parameter, defaultnya adalah 'siswa'
    $selectedRole = request()->get('role', 'siswa');
@endphp

<div class="container d-flex justify-content-center">
    <div class="card login-card p-5">
        <div class="text-center mb-4">
            <img src="{{ asset('img/logo.png') }}" width="60" class="mb-2">
            <h3 class="fw-bold m-0">Pibu</h3>
            <p class="text-muted small">Pinjam buku, gak pakai kaku.</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <input type="hidden" name="role" id="role_input" value="{{ $selectedRole }}">

            <div class="d-flex gap-2 mb-4">
                <button type="button" class="btn flex-fill py-3 btn-role {{ $selectedRole == 'admin' ? 'active' : '' }}"
                        id="btnAdmin" onclick="changeRole('admin')">
                    <i class="bi bi-person-lock fs-4"></i> <br> <span class="small">Sign as Admin</span>
                </button>
                <button type="button" class="btn flex-fill py-3 btn-role {{ $selectedRole == 'siswa' ? 'active' : '' }}"
                        id="btnSiswa" onclick="changeRole('siswa')">
                    <i class="bi bi-mortarboard fs-4"></i> <br> <span class="small">Sign as Siswa</span>
                </button>
            </div>

            @if($errors->any())
                <div class="alert alert-danger small py-2 rounded-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Email<span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="nama@pibu.com" required value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Password<span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-login w-100 shadow-sm">Log in</button>

            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-success text-decoration-none small fw-bold">Kembali ke Beranda</a>
            </div>
        </form>
    </div>
</div>

<script>
    function changeRole(role) {
        // 1. Update nilai input hidden agar ikut terkirim ke server
        document.getElementById('role_input').value = role;

        // 2. Update tampilan visual tombol
        const bAdmin = document.getElementById('btnAdmin');
        const bSiswa = document.getElementById('btnSiswa');

        if (role === 'admin') {
            bAdmin.classList.add('active');
            bSiswa.classList.remove('active');
        } else {
            bSiswa.classList.add('active');
            bAdmin.classList.remove('active');
        }
    }
</script>

</body>
</html>
