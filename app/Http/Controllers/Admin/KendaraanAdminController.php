<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class KendaraanAdminController extends Controller
{
    public function index()
    {
        return view('admin.kendaraan.index');
    }
}
