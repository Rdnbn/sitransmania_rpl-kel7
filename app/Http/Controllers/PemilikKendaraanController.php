<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class PemilikKendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::where('id_pemilik', auth()->id())->get();

        return view('pemilik.kendaraan.index', compact('kendaraan'));
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::where('id_pemilik', auth()->id())
                        ->findOrFail($id);

        return view('pemilik.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::where('id_pemilik', auth()->id())
                        ->findOrFail($id);

        $request->validate([
            'status' => 'required|in:tersedia,tidak tersedia,tidak aktif',
            'keterangan' => 'nullable|string',
            'tanggal_tersedia' => 'nullable|date'
        ]);

        $kendaraan->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'tanggal_tersedia' => $request->tanggal_tersedia
        ]);

        return redirect()->route('pemilik.kendaraan')
            ->with('success', 'Status kendaraan berhasil diperbarui!');
    }
}
