<?php

namespace App\Services;

use App\Models\Notifikasi;

class NotificationService
{
    public static function send($id_user, $id_peminjaman, $judul, $pesan)
    {
        return Notifikasi::create([
            'id_user' => $id_user,
            'id_peminjaman' => $id_peminjaman,
            'judul' => $judul,
            'pesan' => $pesan,
            'is_read' => 0
        ]);
    }
}
