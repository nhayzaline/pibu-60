<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\peminjamans;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Peminjaman;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = DB::table('peminjamans')->distinct('judul_buku')->count('judul_buku');
        $totalAnggota = User::count();
        $bukuDipinjam = Peminjaman::where('status', 'Dipinjam')->count();
        $bukuTersedia = $totalBuku - $bukuDipinjam;

        $peminjamanTerbaru = Peminjaman::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $bukuPopuler = Peminjaman::select('judul_buku', DB::raw('count(*) as total'))
            ->groupBy('judul_buku')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBuku', 'totalAnggota', 'bukuDipinjam', 'bukuTersedia',
            'peminjamanTerbaru', 'bukuPopuler'
        ));
    }

    public function transaksi()
    {
        $transactions = Peminjaman::with(['user', 'book'])->latest()->get();
        return view('admin.transaksi', compact('transactions'));
    }

    public function laporan() {
        $totalPinjamBulanIni = Peminjaman::whereMonth('created_at', date('m'))->count();
        $bukuSedangDipinjam = Peminjaman::where('status', 'Dipinjam')->count();
        $anggotaAktif = User::where('role', 'siswa')->count();
        $peminjamanTerbaru = Peminjaman::with(['user', 'book'])->latest()->take(5)->get();

    $bukuPopuler = Peminjaman::select('judul_buku', \DB::raw('count(*) as total'))
                                                            ->groupBy('judul_buku')
                                                            ->orderBy('total', 'desc')
                                                            ->limit(5)
                                                            ->get();

        return view('admin.laporan', compact(
            'totalPinjamBulanIni', 'bukuSedangDipinjam', 'anggotaAktif',
            'peminjamanTerbaru', 'bukuPopuler'
        ));
    }

    public function anggota()
    {
        $members = User::where('role', 'siswa')->get();
        return view('admin.anggota', compact('members'));
    }

}
