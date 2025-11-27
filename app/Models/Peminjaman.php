<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_peminjam',
        'id_kendaraan',
        'tanggal_pinjam',
        'waktu_pinjam',
        'tanggal_kembali',
        'waktu_kembali',
        'status_peminjaman',
        'total_biaya'
    ];

  public function peminjam() {
    return $this->belongsTo(User::class, 'id_peminjam');
}

public function pemilik() {
    return $this->belongsTo(User::class, 'id_pemilik');
}

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_peminjaman');
    }

    public function chat()
    {
        return $this->hasMany(ChatMessage::class, 'id_peminjaman');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_peminjaman');
    }
}
