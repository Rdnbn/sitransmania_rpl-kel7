<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    // LIST KENDARAAN PEMILIK
    public function index()
    {
        $kendaraan = Kendaraan::where('id_pemilik', auth()->id())->get();

        return view('pemilik.kendaraan.index', compact('kendaraan'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('pemilik.kendaraan.create');
    }

    // SIMPAN DATA KENDARAAN
    public function store(Request $request)
    {
        $request->validate([
            'tipe'        => 'required',
            'merk'        => 'required',
            'plat_nomor'  => 'required|unique:kendaraan',
            'harga_sewa'  => 'required|numeric',
            'status'      => 'required',
            'deskripsi'   => 'nullable',
            'foto'        => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // HANDLE UPLOAD FOTO
        $fotoName = null;
        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('uploads/kendaraan'), $fotoName);
        }

        // SIMPAN DATABASE
        Kendaraan::create([
            'id_pemilik'  => auth()->id(),
            'tipe'        => $request->tipe,
            'merk'        => $request->merk,
            'plat_nomor'  => $request->plat_nomor,
            'harga_sewa'  => $request->harga_sewa,
            'status'      => $request->status,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $fotoName
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    // FORM EDIT
    public function edit($id)
    {
        $kendaraan = Kendaraan::where('id_pemilik', auth()->id())->findOrFail($id);

        return view('pemilik.kendaraan.edit', compact('kendaraan'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::where('id_pemilik', auth()->id())->findOrFail($id);

        $request->validate([
            'tipe'        => 'required',
            'merk'        => 'required',
            'plat_nomor'  => 'required|unique:kendaraan,plat_nomor,' . $id . ',id_kendaraan',
            'harga_sewa'  => 'required|numeric',
            'status'      => 'required',
            'deskripsi'   => 'nullable',
            'foto'        => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // FOTO BARU
        if ($request->hasFile('foto')) {
            if ($kendaraan->foto && file_exists(public_path('uploads/kendaraan/' . $kendaraan->foto))) {
                unlink(public_path('uploads/kendaraan/' . $kendaraan->foto));
            }

            $fotoName = time() . '_' . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('uploads/kendaraan'), $fotoName);
            $kendaraan->foto = $fotoName;
        }

        // UPDATE DATA
        $kendaraan->update([
            'tipe'        => $request->tipe,
            'merk'        => $request->merk,
            'plat_nomor'  => $request->plat_nomor,
            'harga_sewa'  => $request->harga_sewa,
            'status'      => $request->status,
            'deskripsi'   => $request->deskripsi,
            'foto'        => $kendaraan->foto
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui!');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $kendaraan = Kendaraan::where('id_pemilik', auth()->id())->findOrFail($id);

        if ($kendaraan->foto && file_exists(public_path('uploads/kendaraan/' . $kendaraan->foto))) {
            unlink(public_path('uploads/kendaraan/' . $kendaraan->foto));
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
