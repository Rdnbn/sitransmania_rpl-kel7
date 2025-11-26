<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_telp',
        'role',
        'jenis_kelamin',
        'asrama',
        'kamar',
        'prodi',
        'angkatan',
        'foto_profil',
        'qris_image',
        'status_akun',
    ];

    // === RELASI ===

    // Kendaraan milik user
    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'id_pemilik');
    }

    // Peminjaman sebagai peminjam
    public function peminjamanPeminjam()
    {
        return $this->hasMany(Peminjaman::class, 'id_peminjam');
    }

    // Peminjaman sebagai pemilik
    public function peminjamanPemilik()
    {
        return $this->hasMany(Peminjaman::class, 'id_pemilik');
    }

    public function chatTerkirim()
    {
        return $this->hasMany(ChatMessage::class, 'id_pengirim');
    }

    public function chatDiterima()
    {
        return $this->hasMany(ChatMessage::class, 'id_penerima');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'id_user');
    }

    public function aktivitas()
    {
        return $this->hasMany(RiwayatAktivitas::class, 'id_user');
    }
}
