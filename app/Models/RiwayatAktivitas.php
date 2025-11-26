<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatAktivitas extends Model
{
    protected $primaryKey = 'id_aktivitas';

    protected $fillable = [
        'id_user',
        'id_peminjaman',
        'aksi',
        'deskripsi',
        'waktu'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
