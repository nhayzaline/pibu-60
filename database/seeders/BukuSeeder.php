<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $categoryId = DB::table('categories')->insertGetId([
            'category' => 'Novel',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $books = [
            [
                'judul' => 'Aku Tahu Kapan Kamu Mati',
                'ISBN' => '9786021234561',
                'penulis' => 'Arumi E',
                'penerbit' => 'Penerbit A',
                'tahun_terbit' => 2018,
                'stok' => 10,
                'category_id' => $categoryId,
                'cover_image' => 'aku.png',
            ],
            [
                'judul' => 'Mariposa',
                'ISBN' => '9786021234562',
                'penulis' => 'Luluk HF',
                'penerbit' => 'Penerbit B',
                'tahun_terbit' => 2018,
                'stok' => 15,
                'category_id' => $categoryId,
                'cover_image' => 'mariposa.png',
            ],
            [
                'judul' => 'Dilan 1990',
                'ISBN' => '9786021234563',
                'penulis' => 'Pidi Baiq',
                'penerbit' => 'Pastel Books',
                'tahun_terbit' => 2014,
                'stok' => 20,
                'category_id' => $categoryId,
                'cover_image' => 'dilan.png',
            ],
            [
                'judul' => 'Ragam Indonesia',
                'ISBN' => '9786021234564',
                'penulis' => 'Tim Penulis',
                'penerbit' => 'Penerbit C',
                'tahun_terbit' => 2020,
                'stok' => 5,
                'category_id' => $categoryId,
                'cover_image' => 'ragam.png',
            ],
            [
                'judul' => 'Dompet Ayah Sepatu Ibu',
                'ISBN' => '9786021234565',
                'penulis' => 'JS Khairen',
                'penerbit' => 'Penerbit D',
                'tahun_terbit' => 2023,
                'stok' => 12,
                'category_id' => $categoryId,
                'cover_image' => 'dasi.png',
            ],
        ];

        DB::table('books')->insert($books);
    }
}
