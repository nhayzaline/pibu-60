<?php

// Di bagian paling atas file web.php
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Admin\DashboardController;

// Pastikan tidak ada duplikasi route /admin/dashboard di luar grup ini
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'is_admin']], function () {
    Route::get('/laporan', [DashboardController::class, 'laporan'])->name('laporan');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/anggota', [DashboardController::class, 'anggota'])->name('anggota');

    // Tambahkan baris ini
    Route::get('/transaksi', [DashboardController::class, 'transaksi'])->name('transaksi');

    Route::get('/buku/tambah', [DashboardController::class, 'create'])->name('buku.create');
    Route::post('/buku/store', [DashboardController::class, 'store'])->name('buku.store');
});

// 1. Route Umum & Auth
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. Route Siswa (Semua yang butuh login dikumpulkan di sini)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');

    // Fitur Pinjam Buku
    Route::get('/siswa/pinjam', [SiswaController::class, 'pinjam'])->name('siswa.pinjam');
    Route::post('/siswa/pinjam/proses', [SiswaController::class, 'ajukanPinjam'])->name('siswa.ajukanPinjam');

    // Fitur Kembalikan Buku
    Route::get('/siswa/kembali', [SiswaController::class, 'kembali'])->name('siswa.kembali');

    // Fitur Riwayat & Cari
    Route::get('/siswa/riwayat', [SiswaController::class, 'riwayat'])->name('siswa.riwayat');
    Route::get('/siswa/cari', [SiswaController::class, 'cari'])->name('siswa.cari');
    // Tambahkan route ini agar tombol kembalikan bisa mengirim data ke Controller
    Route::post('/siswa/kembali/{id}', [SiswaController::class, 'prosesKembali'])->name('siswa.prosesKembali');
});
