<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $primaryKey = 'id_kendaraan';

    protected $fillable = [
        'id_pemilik',
        'tipe',
        'plat',
        'status',
        'harga_sewa',
        'foto'
    ];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'id_pemilik');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_kendaraan');
    }

    public function lokasi()
    {
        return $this->hasMany(LokasiKendaraan::class, 'id_kendaraan');
    }
}
