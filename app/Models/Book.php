<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
    'judul',
    'penulis',
    'penerbit', // Pastikan ini ada
    'ISBN',
    'tahun_terbit',
    'stok',
    'category_id'
    ];

    public function peminjamans()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_buku', 'id');
    }

    public function detail_peminjamans()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_buku');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'ISBN' => 'required|string|unique:books,ISBN',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        \App\Models\Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'ISBN' => $request->ISBN,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Buku berhasil ditambahkan ke stok.');
    }
}
