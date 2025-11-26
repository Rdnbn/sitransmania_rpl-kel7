<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;

class AktivitasController extends Controller
{
    public function index()
    {
        return view('pemilik.aktivitas.index');
    }

    public function liveMap($id)
    {
        return view('pemilik.aktivitas.live-map');
    }
}
