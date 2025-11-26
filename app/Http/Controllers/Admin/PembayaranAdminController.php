<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PembayaranAdminController extends Controller
{
    public function index()
    {
        return view('admin.pembayaran.index');
    }
}
