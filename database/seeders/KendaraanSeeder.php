<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $pemilik_id = [2,3,4]; // dari UsersSeeder

        $kendaraanList = [
            ['Honda Vario 125', 'Motor', 'hitam', 'DK 1234 AA'],
            ['Yamaha N-Max', 'Motor', 'putih', 'DK 9876 BB'],
            ['Toyota Avanza', 'Mobil', 'silver', 'DK 1111 CC'],
            ['Honda Brio', 'Mobil', 'kuning', 'DK 2222 DD'],
            ['Suzuki Ertiga', 'Mobil', 'hitam', 'DK 3333 EE'],
        ];

        foreach ($kendaraanList as $i => $k) {
            Kendaraan::create([
                'id_pemilik' => $pemilik_id[$i % 3],
                'tipe' => $k[0],
                'jenis' => $k[1],
                'warna' => $k[2],
                'plat_nomor' => $k[3],
                'status' => 'tersedia'
            ]);
        }
    }
}
