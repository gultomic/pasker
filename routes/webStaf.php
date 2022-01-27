<?php

use Illuminate\Support\Facades\Route;

Route::name('staf.')
    ->prefix('staf')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/history-pelayanan', function () {
            return view('dashboard', [
                'title' => 'Riwayat',
                'header' => 'History Pelayanan',
            ]);
        })->name('pelayanan.history');

        Route::get('/profile', function () {
            return view('dashboard', [
                'title' => 'Profil',
                'header' => 'Profil Member',
            ]);
        })->name('profile');
    });
