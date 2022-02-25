<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

        Route::get('/history-pelayanan-pdf', function(Request $request) {
            $title = $request->session()->get('title');
            $tit = str_replace(" ","_",strtolower($title));
            $tim = \Carbon\Carbon::now()->format('Ymd-His');
            $pdf = PDF::loadview('dompdf.riwayat_pelayanan', [
                'collection' => $request->session()->get('collection'),
                'title' => $request->session()->get('title')
            ]);
            return $pdf->stream($tit."_".$tim.".xlsx");
        })->name('pelayanan.history.pdf');
    });
