<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiKendaraan extends Model
{
    protected $primaryKey = 'id_lokasi';

    protected $fillable = [
        'id_kendaraan',
        'latitude',
        'longitude',
        'waktu_update'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }
}