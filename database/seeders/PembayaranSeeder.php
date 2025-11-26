<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1,5) as $i) {
            Pembayaran::create([
                'id_peminjaman' => $i,
                'bukti' => 'dummy'.$i.'.jpg',
                'status' => ['menunggu', 'valid', 'ditolak'][rand(0,2)]
            ]);
        }
    }
}
