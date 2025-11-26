<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\ActivityService;

class AkunController extends Controller
{
    // ===============================
    // 1. LIST USER
    // ===============================
    public function list()
    {
        $users = User::orderBy('nama')->get();
        return view('admin.akun.list', compact('users'));
    }

    // ===============================
    // 2. FORM TAMBAH USER
    // ===============================
    public function create()
    {
        return view('admin.akun.create');
    }

    // ===============================
    // 3. SIMPAN USER BARU
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'no_telp'  => $request->no_telp,
        ]);

        return redirect()->route('admin.akun.list')->with('success', 'User berhasil ditambahkan.');
    }


    // ===============================
    // 4. EDIT USER
    // ===============================
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.akun.edit', compact('user'));
    }

    // ===============================
    // 5. UPDATE USER
    // ===============================
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id_user',
            'role' => 'required'
        ]);

        $user->nama    = $request->nama;
        $user->email   = $request->email;
        $user->no_telp = $request->no_telp;
        $user->role    = $request->role;
        $user->save();

        return back()->with('success', 'User berhasil diperbarui.');
    }


    // ===============================
    // 6. HAPUS USER
    // ===============================
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }


    // ===============================
    // 7. RESET PASSWORD
    // ===============================
    public function resetPage()
    {
        $users = User::orderBy('nama')->get();
        return view('admin.akun.reset', compact('users'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id_user',
        ]);

        $user = User::find($request->id_user);

        $newPass = "sitrans123";
        $user->password = Hash::make($newPass);
        $user->save();

        ActivityService::add(
            auth()->id(),
            "Reset Password",
            "Mereset password user: {$user->nama}",
            null
        );

        return back()->with('success', "Password untuk {$user->nama} berhasil direset!");
    }
}
