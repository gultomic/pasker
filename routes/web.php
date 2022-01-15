<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/pelayanan', function () {
    return view('pelayanan', [
        'title' => 'Pelayanan',
        'header' => 'Pelayanan & Konsultasi',
    ]);
})->middleware(['auth'])->name('pelayanan');

Route::get('/akun', function () {
    return view('akun', [
        'title' => 'Akun',
        'header' => 'Akun Member',
    ]);
})->middleware(['auth'])->name('akun');

Route::get('/data-pengunjung', function () {
    return view('pengunjung', [
        'title' => 'Pengunjung',
        'header' => 'Data Pengunjung',
    ]);
})->middleware(['auth'])->name('klien');

Route::get('/pengaturan', function () {
    return view('dashboard', [
        'title' => 'Pengaturan',
        'header' => 'Pengaturan Aplikasi',
    ]);
})->middleware(['auth'])->name('pengaturan');

Route::get('/pertanyaan', function () {
    return view('dashboard', [
        'title' => 'Pertanyaan',
        'header' => 'Daftar Pertanyaan',
    ]);
})->middleware(['auth'])->name('pertanyaan');

require __DIR__.'/auth.php';
