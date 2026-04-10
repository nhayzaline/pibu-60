<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // PENTING: Harus ada ini

class HomeController extends Controller
{
    public function index()
{
    // List judul buku yang ingin dijadikan populer
    $judulPopuler = [
        'Langkah Kecil Menuju Mimpi',
        '5 cm',
        'Timun Jelita',
        'Untukmu, Anak Bungsu',
        'Pramoedya Ananta Toer'
    ];

    // 1. Ambil buku UNTUK KATEGORI (Kecualikan yang ada di list populer)
    $books = Book::whereNotIn('judul', $judulPopuler)->get();

    // 2. Ambil buku UNTUK POPULER (Hanya yang ada di list populer)
    $popularBooks = Book::whereIn('judul', $judulPopuler)->get();

    return view('welcome', compact('books', 'popularBooks'));
}
}
