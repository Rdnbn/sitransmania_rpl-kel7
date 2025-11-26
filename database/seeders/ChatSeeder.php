<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatMessage;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1,5) as $pid) {

            ChatMessage::create([
                'id_peminjaman' => $pid,
                'id_pengirim' => 5,
                'id_penerima' => 2,
                'pesan' => "Halo kak, apakah kendaraan tersedia?",
                'file' => null
            ]);

            ChatMessage::create([
                'id_peminjaman' => $pid,
                'id_pengirim' => 2,
                'id_penerima' => 5,
                'pesan' => "Iya, kendaraan siap digunakan.",
                'file' => null
            ]);
        }
    }
}
