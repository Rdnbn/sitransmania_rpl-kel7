<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PeminjamanAdminController extends Controller
{
    public function index()
    {
        return view('admin.peminjaman.index');
    }
}
