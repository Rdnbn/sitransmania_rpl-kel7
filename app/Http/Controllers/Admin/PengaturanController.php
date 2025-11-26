<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $set = PengaturanSistem::first(); 
        return view('admin.pengaturan.index', compact('set'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kontak_admin' => 'required',
            'max_waktu_pinjam' => 'required|numeric',
            'logo' => 'nullable|image|max:2048',
        ]);

        $set = PengaturanSistem::first();

        if ($request->hasFile('logo')) {
            $fileName = time() . '-' . $request->logo->getClientOriginalName();
            $request->logo->move(public_path('uploads/logo'), $fileName);
            $set->logo = $fileName;
        }

        $set->nama = $request->nama;
        $set->deskripsi = $request->deskripsi;
        $set->aturan = $request->aturan;
        $set->kontak_admin = $request->kontak_admin;
        $set->max_waktu_pinjam = $request->max_waktu_pinjam;
        $set->maintenance = $request->maintenance ? 1 : 0;

        $set->save();

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}
