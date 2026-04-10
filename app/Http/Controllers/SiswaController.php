<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Peminjaman;

class SiswaController extends Controller
{
    public function index()
    {
        $peminjamanAktif = Peminjaman::where('user_id', auth()->id())
                                        ->where('status', 'Dipinjam')
                                        ->get();

        return view('siswa.dashboard', compact('peminjamanAktif'));
    }

    public function pinjam()
    {

        $bukuPopuler = Book::limit(5)->get();

        return view('Siswa.pinjam', compact('bukuPopuler'));
    }

    public function kembali()
    {
        $pinjaman = Peminjaman::where('user_id', auth()->id())
                                ->with('book')
                                ->get();

        return view('Siswa.kembali', compact('pinjaman'));
    }

    public function cari()
    {
        $koleksiBuku = \App\Models\Peminjaman::select('judul_buku as judul')
                                                ->distinct()
                                                ->get();

        $fiturCepat = ['Fisika', 'Matematika', 'Informatika', 'Bahasa'];

        return view('Siswa.cari', compact('koleksiBuku', 'fiturCepat'));
    }

    public function riwayat()
    {
        $userId = auth()->id();

        $dataRiwayat = \App\Models\Peminjaman::where('user_id', $userId)
                                                ->orderBy('created_at', 'desc')
                                                ->get();

        $stats = [
            'total' => $dataRiwayat->count(),
            'tepat_waktu' => $dataRiwayat->where('status', 'Dikembalikan')
                        ->where('updated_at', '<=', 'tenggat_kembali')->count(),
            'terlambat' => $dataRiwayat->where('status', 'Dikembalikan')
                        ->where('updated_at', '>', 'tenggat_kembali')->count(),
            'denda' => 0
        ];

        return view('Siswa.riwayat', compact('dataRiwayat', 'stats'));
    }

    public function ajukanPinjam(Request $request)
    {
        return redirect()->back()->with('success', 'Permohonan pinjam berhasil dikirim!');
    }

}
