<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'admin', 'access'])
    ->group(function() {
        Route::get('/pelayanan', function () {
            return view('admin.pelayanan', [
                'title' => 'Pelayanan',
                'header' => 'Pelayanan & Konsultasi',
            ]);
        })->name('pelayanan');

        Route::get('/pelayanan/{id}/kuesioner', function ($id) {
            return view('admin.kuesioner', [
                'title' => 'Kuesioner',
                'header' => 'Kuesioner Pertanyaan',
                'id' => $id,
            ]);
        })->name('pelayanan.kuesioner');

        Route::get('/pelayanan/{id}/history', function ($id) {
            return view('pelayanan.history', [
                'title' => 'History',
                'header' => 'Riwayat Pengunjung',
                'id' => $id,
            ]);
        })->name('pelayanan.history');

        Route::get('/pelayanan/history-pdf', function(Request $request) {
            $title = $request->session()->get('title');
            $tit = str_replace(" ","_",strtolower($title));
            $tim = \Carbon\Carbon::now()->format('Ymd-His');
            $pdf = PDF::loadview('dompdf.riwayat_pelayanan', [
                'collection' => $request->session()->get('collection'),
                'title' => $request->session()->get('title')
            ]);
            return $pdf->stream($tit."_".$tim.".xlsx");
        })->name('pelayanan.history.pdf');

        Route::get('/akun', function () {
            return view('admin.akun', [
                'title' => 'Akun',
                'header' => 'Akun Member',
            ]);
        })->name('akun');

        Route::get('/akun/{id}/show', function ($id) {
            return view('admin.akunShow', [
                'title' => 'Akun',
                'header' => 'Rincian Data Member',
                'id' => $id,
            ]);
        })->name('akun.show');

        Route::get('/data-pengunjung', function () {
            return view('admin.pengunjung', [
                'title' => 'Pengunjung',
                'header' => 'Master Pengunjung',
            ]);
        })->name('klien');

        Route::get('/data-pengunjung/{id}/show', function ($id) {
            return view('admin.pengunjungShow', [
                'title' => 'Pengunjung',
                'header' => 'Rincian Data Pengunjung',
                'id' => $id,
            ]);
        })->name('klien.show');

        Route::get('/pengaturan', function () {
            return view('admin.pengaturan', [
                'title' => 'Pengaturan',
                'header' => 'Pengaturan Aplikasi',
            ]);
        })->name('pengaturan');

        Route::get('/pertanyaan', function () {
            return view('admin.pertanyaan', [
                'title' => 'Pertanyaan',
                'header' => 'Daftar Pertanyaan',
            ]);
        })->name('pertanyaan');

        Route::get('export-leaderboard-pelaksana', [DashboardController::class, 'adminStafExport'])->name('pelaksana.export');
        Route::get('tabel-pelaksana-pdf', [DashboardController::class, 'adminStafPdf'])->name('pelaksana.pdf');
    });
