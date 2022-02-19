<?php

use Illuminate\Support\Facades\Route;

Route::name('staf.')
    ->prefix('staf')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/history-pelayanan', function () {
            return view('staf.pelayanan-history', [
                'title' => 'Riwayat',
                'header' => 'History Pelayanan',
            ]);
        })->name('pelayanan.history');
    });
