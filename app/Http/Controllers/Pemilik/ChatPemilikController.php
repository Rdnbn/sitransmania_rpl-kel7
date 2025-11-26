<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;

class ChatPemilikController extends Controller
{
    public function index()
    {
        return view('pemilik.chat.index');
    }

    public function show($room)
    {
        return view('pemilik.chat.show');
    }
}
