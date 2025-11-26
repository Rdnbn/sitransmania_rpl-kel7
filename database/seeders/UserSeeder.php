<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Admin SITRANSMANIA',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Pemilik
        foreach ([
            ['Budi Santoso', 'budi@gmail.com'],
            ['Siti Aminah', 'siti@gmail.com'],
            ['Rizal Ahmad', 'rizal@gmail.com'],
        ] as $p) {
            User::create([
                'nama' => $p[0],
                'email' => $p[1],
                'password' => Hash::make('pemilik123'),
                'role' => 'pemilik',
            ]);
        }

        // Peminjam
        foreach ([
            ['Dewi Lestari', 'dewi@gmail.com'],
            ['Rama Putra', 'rama@gmail.com'],
            ['Andi Pratama', 'andi@gmail.com'],
        ] as $p) {
            User::create([
                'nama' => $p[0],
                'email' => $p[1],
                'password' => Hash::make('peminjam123'),
                'role' => 'peminjam',
            ]);
        }
    }
}
