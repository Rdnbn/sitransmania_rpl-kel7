<?php

namespace App\Services;

use App\Models\RiwayatAktivitas;

class ActivityService
{
    public static function add($id_user, $aksi, $deskripsi, $id_peminjaman = null)
    {
        RiwayatAktivitas::create([
            'id_user'       => $id_user,
            'aksi'          => $aksi,
            'deskripsi'     => $deskripsi,
            'id_peminjaman' => $id_peminjaman,
            'waktu'         => now()
        ]);
    }
}
