<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required', 'in:pemilik,peminjam'], // penting!
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], 
        ]);

        Auth::login($user);

        // Redirect sesuai role
        if ($user->role === 'pemilik') {
            return redirect()->route('pemilik.dashboard');
        }

        if ($user->role === 'peminjam') {
            return redirect()->route('peminjam.dashboard');
        }

        return redirect('/dashboard');
    }
}
