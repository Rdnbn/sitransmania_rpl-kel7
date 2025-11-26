<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;

class PeminjamController extends Controller
{
    public function index()
    {
        return view('pemilik.peminjam.index');
    }
}
