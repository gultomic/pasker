<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/pelayanan', function () {
            return view('admin.pelayanan', [
                'title' => 'Pelayanan',
                'header' => 'Pelayanan & Konsultasi',
            ]);
        })->name('pelayanan');

        Route::get('/akun', function () {
            return view('admin.akun', [
                'title' => 'Akun',
                'header' => 'Akun Member',
            ]);
        })->name('akun');

        Route::get('/data-pengunjung', function () {
            return view('admin.pengunjung', [
                'title' => 'Pengunjung',
                'header' => 'Data Pengunjung',
            ]);
        })->name('klien');

        Route::get('/pengaturan', function () {
            return view('dashboard', [
                'title' => 'Pengaturan',
                'header' => 'Pengaturan Aplikasi',
            ]);
        })->name('pengaturan');

        Route::get('/pertanyaan', function () {
            return view('dashboard', [
                'title' => 'Pertanyaan',
                'header' => 'Daftar Pertanyaan',
            ]);
        })->name('pertanyaan');
    });
