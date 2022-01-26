<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;


// Route::get('/', function () {
//     return view('welcome', [
//         'collection' => App\Models\Pelayanan::latest()->get()
//     ]);
// })->name('home');

Route::get('/monitor', function () {
    return view('monitor',[
        'title' => 'Signane',
        'loket' => App\Models\Config::where('title', 'loket_pelayanan')
            ->first()
            ->refs
    ]);
})->name('monitor');

Route::get('/signage', function () {
    return view('signage',[
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


Route::get('/', function () {
    return view('registration.online.home',[
        'pelayanan' => App\Models\Pelayanan::latest()
        ->where('refs->aktif', '=', true)
        ->get()
    ]);
})->name('registration.online.home');


Route::post('/regist', [RegistrationController::class, 'online_submit'])->name('registration.online.submit');



Route::get('/register-success', function () {
    return view('registration.online.success',[
        'pelayanan' => App\Models\Pelayanan::latest()
        ->where('refs->aktif', '=', true)
        ->get()
    ]);
})->name('registration.online.success');


Route::get('/kiosk', function () {
    return view('registration.offline.home',[
        'pelayanan' => App\Models\Pelayanan::latest()
        ->where('refs->aktif', '=', true)
        ->get()
    ]);
})->name('kiosk.homepage');

Route::post('/kiosk/submit-phone', [RegistrationController::class, 'kiosk_submit_phone'])->name('kiosk.submit_phone');
Route::post('/kiosk/submit', [RegistrationController::class, 'kiosk_submit'])->name('kiosk.submit');



require __DIR__.'/auth.php';
