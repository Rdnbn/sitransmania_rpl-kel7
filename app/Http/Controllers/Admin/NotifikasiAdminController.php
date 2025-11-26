<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NotifikasiAdminController extends Controller
{
    public function index()
    {
        return view('admin.notifikasi.index');
    }
}
