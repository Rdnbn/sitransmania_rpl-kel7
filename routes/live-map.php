<?php
use App\Http\Controllers\LiveMapController;

Route::get('/live-map/{id_kendaraan}', [LiveMapController::class, 'index'])
    ->name('livemap.index');

Route::get('/live-map/data/{id_kendaraan}', [LiveMapController::class, 'fetch'])
    ->name('livemap.fetch');
