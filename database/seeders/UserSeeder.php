<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'siswa@pibu.com'],
            [
                'name' => 'Siswa Pibu',
                'password' => Hash::make('password'),
            ]
        );
    }
}
