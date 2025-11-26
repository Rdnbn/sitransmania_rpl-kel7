<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;

class BrowseKendaraanController extends Controller
{
    public function index()
    {
        return view('peminjam.browse.index');
    }

    public function detail($id)
    {
        return view('peminjam.browse.detail');
    }
}
