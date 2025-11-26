<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peminjaman;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $peminjam_id = [5,6,7]; // user role peminjam
        $kendaraan_id = [1,2,3,4,5];

        foreach ($kendaraan_id as $i => $kid) {
            Peminjaman::create([
                'id_kendaraan' => $kid,
                'id_peminjam' => $peminjam_id[$i % 3],
                'status' => ['menunggu', 'disetujui', 'dipakai', 'selesai'][$i % 4],
                'tgl_pinjam' => now()->subDays(rand(1,7)),
                'tgl_kembali' => now()->addDays(rand(1,5)),
                'tujuan' => 'Keperluan perjalanan harian'
            ]);
        }
    }
}
