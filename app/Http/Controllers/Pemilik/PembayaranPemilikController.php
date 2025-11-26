<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;

class PembayaranPemilikController extends Controller
{
    public function index()
    {
        return view('pemilik.pembayaran.index');
    }
}
