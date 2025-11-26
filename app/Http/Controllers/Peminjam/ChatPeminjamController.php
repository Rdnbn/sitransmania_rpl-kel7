<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;

class ChatPeminjamController extends Controller
{
    public function index()
    {
        return view('peminjam.chat.index');
    }

    public function show($room)
    {
        return view('peminjam.chat.show');
    }
}
