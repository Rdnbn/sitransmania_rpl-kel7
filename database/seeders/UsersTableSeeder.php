<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id_user' => 6,
                'nama' => 'Radin Bina Aisyah',
                'email' => 'rdnbn73@gmail.com',
                'password' => '$2y$12$ObaSAeKPK4xG62RDBP7MJeTTLFh4YF4iZIVzfudIqKhwO8.bejI4u',
                'no_telp' => '081234567890',
                'role' => 'pemilik',
                'jenis_kelamin' => 'P',
                'asrama' => 'Tulip',
                'kamar' => '319',
                'prodi' => 'S1 Pendidikan Teknik Informatika',
                'angkatan' => '2024',
                'foto_profil' => null,
                'status_akun' => 'aktif',
                'created_at' => '2025-11-21 02:43:13',
                'updated_at' => '2025-11-21 02:43:13',
            ],
            [
                'id_user' => 7,
                'nama' => 'pemilik',
                'email' => 'pemilik@gmail.com',
                'password' => '$2y$12$FN77QawYF/nU/.8xAO3X3exiEcU8F.MUkuE.pQnwAaVPGA5fyaCwW',
                'no_telp' => '085123123123',
                'role' => 'pemilik',
                'jenis_kelamin' => 'L',
                'asrama' => 'Aster',
                'kamar' => '123123',
                'prodi' => 'Desain Komunikasi Visual',
                'angkatan' => '2024',
                'foto_profil' => null,
                'status_akun' => 'aktif',
                'created_at' => '2025-11-22 02:36:57',
                'updated_at' => '2025-11-22 02:36:57',
            ],
        ]);
    }
}
