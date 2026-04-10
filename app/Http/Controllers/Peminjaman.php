<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class peminjamans extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required',
        ]);

        Peminjaman::create([
            'user_id'         => Auth::id(),
            'judul_buku'      => $request->judul_buku,
            'status'          => 'Dipinjam',
            'tgl_pinjam'      => Carbon::now()->toDateString(),
            'tenggat_kembali' => Carbon::now()->addDays(14)->toDateString()
        ]);

        return redirect()->route('siswa.riwayat')->with('success', 'Buku berhasil dipinjam!');
    }
}
