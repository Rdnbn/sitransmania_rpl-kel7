<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {

    // Web Publik
    Route::middleware('web')
        ->group(base_path('routes/web.php'));

    // Admin
    Route::middleware(['web','auth','role:admin'])
        ->prefix('admin')
        ->as('admin.')
        ->group(base_path('routes/admin.php'));

    // Pemilik
    Route::middleware(['web','auth','role:pemilik'])
        ->prefix('pemilik')
        ->as('pemilik.')
        ->group(base_path('routes/pemilik.php'));

    // Peminjam
    Route::middleware(['web','auth','role:peminjam'])
        ->prefix('peminjam')
        ->as('peminjam.')
        ->group(base_path('routes/peminjam.php'));

    // API
    Route::middleware('api')
        ->prefix('api')
        ->group(base_path('routes/api.php'));
    });

    }
}
