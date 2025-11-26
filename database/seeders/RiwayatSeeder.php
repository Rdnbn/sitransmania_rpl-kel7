<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RiwayatAktivitas;

class RiwayatSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1,5) as $pid) {
            RiwayatAktivitas::create([
                'id_user' => 5,
                'aksi' => 'Peminjaman Dibuat',
                'deskripsi' => 'Mengajukan peminjaman kendaraan',
                'id_peminjaman' => $pid,
                'waktu' => now()->subDays(rand(1,3)),
            ]);
        }
    }
}
