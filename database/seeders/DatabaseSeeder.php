<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
{
    $this->call([
            UsersSeeder::class,
            KendaraanSeeder::class,
            PeminjamanSeeder::class,
            PembayaranSeeder::class,
            ChatSeeder::class,
            LokasiSeeder::class,
            RiwayatSeeder::class,
        ]);
        
    \App\Models\User::factory()->create([
        'nama' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin123'),
        'role' => 'admin'
    ]);

    \App\Models\User::factory()->create([
        'nama' => 'Pemilik',
        'email' => 'pemilik@gmail.com',
        'password' => bcrypt('pemilik123'),
        'role' => 'pemilik'
    ]);

    \App\Models\User::factory()->create([
        'nama' => 'Peminjam',
        'email' => 'peminjam@gmail.com',
        'password' => bcrypt('peminjam123'),
        'role' => 'peminjam'
    ]);
}
}
