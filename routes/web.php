<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome', [
        'title' => 'Beranda',
        'collection' => App\Models\Pelayanan::latest()->get()
    ]);
})->name('home');

Route::get('/monitor', function () {
    return view('monitor',[
        'title' => 'Signane',
        'loket' => App\Models\Config::where('title', 'loket_pelayanan')
            ->first()
            ->refs
    ]);
})->name('monitor');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/pelayanan/{id}', function ($id) {
    return view('staf.pelayanan', [
        'title' => 'Pelayanan',
        'header' => App\Models\Pelayanan::find($id)->title,
        'id' => $id,
    ]);
})->middleware(['auth'])->name('dashboard.pelayanan');

require __DIR__.'/auth.php';
