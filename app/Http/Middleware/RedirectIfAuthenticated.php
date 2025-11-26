<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $role = auth()->user()->role;

            return match ($role) {
                'admin'   => redirect()->route('admin.dashboard'),
                'pemilik' => redirect()->route('pemilik.dashboard'),
                'peminjam'=> redirect()->route('peminjam.dashboard'),
                default   => redirect('/'),
            };
        }

        return $next($request);
    }
}
