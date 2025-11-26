<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // Halaman login
    public function create()
    {
        return view('auth.login');
    }

    // Proses login
    public function store(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($credentials)) {
        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'pemilik') {
        return redirect()->route('pemilik.dashboard');
    }

    if ($user->role === 'peminjam') {
        return redirect()->route('peminjam.dashboard');
    }

    return redirect('/');
    }
    
    // Logout
    public function destroy(Request $request)
    {
        Auth::guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
