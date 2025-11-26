<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('pemilik.akun.index', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'no_telp' => 'required|string',
            'foto_profil' => 'nullable|image|max:2048',
            'qris' => 'nullable|image|max:2048', // khusus pemilik
        ]);

        $user = auth()->user();

        // Foto profil
        if ($request->hasFile('foto_profil')) {
            $fileName = time() . '-' . $request->foto_profil->getClientOriginalName();
            $request->foto_profil->move(public_path('uploads/profil'), $fileName);
            $user->foto_profil = $fileName;
        }

        // QRIS khusus pemilik
        if ($request->hasFile('qris')) {
            $fileName = time() . '-' . $request->qris->getClientOriginalName();
            $request->qris->move(public_path('uploads/qris'), $fileName);
            $user->qris = $fileName;
        }

        $user->nama = $request->nama;
        $user->no_telp = $request->no_telp;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function password(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama salah.');
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
