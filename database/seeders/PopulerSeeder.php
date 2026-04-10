<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class PopulerSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'judul' => 'Langkah Kecil Menuju Mimpi',
            'cover_image' => 'langkah.png',
            'stok' => 5,
            'category_id' => 1,
            'ISBN' => '978-123-456-1', 
            'penulis' => 'Penulis A',
            'penerbit' => 'Penerbit A',
            'tahun_terbit' => 2024
        ]);

        Book::create([
            'judul' => '5 cm',
            'cover_image' => '5cm.png',
            'stok' => 3,
            'category_id' => 1,
            'ISBN' => '978-123-456-2',
            'penulis' => 'Donny Dhirgantoro',
            'penerbit' => 'Grasindo',
            'tahun_terbit' => 2005
        ]);

        Book::create([
            'judul' => 'Timun Jelita',
            'cover_image' => 'timun.png',
            'stok' => 3,
            'category_id' => 1,
            'ISBN' => '978-123-456-3',
            'penulis' => 'Penulis C',
            'penerbit' => 'Penerbit C',
            'tahun_terbit' => 2023
        ]);

        Book::create([
            'judul' => 'Untukmu, Anak Bungsu',
            'cover_image' => 'untukmu.png',
            'stok' => 3,
            'category_id' => 1,
            'ISBN' => '978-123-456-4',
            'penulis' => 'Penulis D',
            'penerbit' => 'Penerbit D',
            'tahun_terbit' => 2022
        ]);

        Book::create([
            'judul' => 'Pramoedya Ananta Toer',
            'cover_image' => 'pramo.png',
            'stok' => 3,
            'category_id' => 1,
            'ISBN' => '978-123-456-5',
            'penulis' => 'Pramoedya Ananta Toer',
            'penerbit' => 'Lentera Dipantara',
            'tahun_terbit' => 1980
        ]);
    }
}
