<?php

use App\Http\Controllers\SurveyController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Session;
use App\Faker;
//use Illuminate\Support\Facades\Crypt;
//use Illuminate\Contracts\Encryption\DecryptException;

// Route::get('/', function () {
//     return view('welcome', [
//         'collection' => App\Models\Pelayanan::latest()->get()
//     ]);
// })->name('home');

Route::get('/monitor', function () {
    return view('monitor', [
        'title' => 'Signane',
        'loket' => App\Models\Config::where('title', 'loket_pelayanan')
            ->first()
            ->refs
    ]);
});

//Route::get('/decrypt', function () {
//    $string = "";
//    try {
//        $decrypted = Crypt::decryptString($string);
//        return "ini".$decrypted;
//    } catch (DecryptException $e) {
//        //
//        return $e;
//    }
//});

Route::get('/midone/dashboard1', function () {


    $fakerData = [];
    for ($i = 0; $i < 20; $i++) {
        $fakerData[] = [
            'users' => Faker::fakeUsers(),
            'photos' => Faker::fakePhotos(),
            'images' => Faker::fakeImages(),
            'dates' => Faker::fakeDates(),
            'times' => Faker::fakeTimes(),
            'formatted_times' => Faker::fakeFormattedTimes(),
            'totals' => Faker::fakeTotals(),
            'true_false' => Faker::fakeTrueFalse(),
            'stocks' => Faker::fakeStocks(),
            'products' => Faker::fakeProducts(),
            'news' => Faker::fakeNews(),
            'files' => Faker::fakeFiles(),
            'jobs' => Faker::fakeJobs(),
            'notification_count' => Faker::fakeNotificationCount(),
            'foods' => Faker::fakeFoods()
        ];
    }
    return view('midone.pages.regular-form', [
        'fakers' => $fakerData,
        'layout' => 'side-menu'
    ]);
})->name('midone.dashboard');

Route::get('/signage', function () {
    $loket = App\Models\Config::where('title', 'loket_pelayanan')->first()->refs;
    $marque = App\Models\Config::where('title', 'list_marquee')->first()->refs;
    $video = App\Models\Config::where('title', 'list_video')->first()->refs;
    $loketJson = [];
    foreach ($loket as $k => $v) {
        $loketJson[$k]['name'] = $v;

        $col = \App\Models\Config::
        where('title', str_replace(' ', '', strtolower($v)) . '_call')
            ->where('refs->tanggal', '=', Carbon::now()->format('Y-m-d'))
            ->first();
        if (!empty($col)) {
            $loketJson[$k]['call'] = $col->refs;
        }

    }
    return view('signage', [
        'title' => 'Signane',
        'loket' => $loket,
        'loketJson' => json_encode($loketJson),
        'marqueJson' => $marque->toJSON(),
        'videoJson' => $video->toJSON()
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


Route::get('/', [RegistrationController::class, 'online_home'])->name('registration.online.home');


Route::post('/regist', [RegistrationController::class, 'online_submit'])->name('registration.online.submit');
Route::post('/get_available_quota', [RegistrationController::class, 'get_quota_per_day'])->name('registration.getQuotaPerDay');


Route::get('/register-success', function () {
    if (empty(Session::exists('booking_time'))) {
        return redirect('/');
    }
    return view('registration.online.success');
})->name('registration.online.success');


Route::get('/pelayanan/list/json', [RegistrationController::class, 'get_pelayanan'])->name('pelayanan.list.json');


Route::get('/kiosk', function () {
    $marque = App\Models\Config::where('title', 'list_marquee')->first()->refs;
    return view('registration.offline.home', [
        'pelayanan' => App\Models\Pelayanan::latest()
            ->where('refs->aktif', '=', true)
            ->get(),
        'marqueJson' => $marque->toJSON()
    ]);
})->name('kiosk.homepage');

Route::post('/kiosk/submit-phone', [RegistrationController::class, 'kiosk_submit_phone'])->name('kiosk.submit_phone');
Route::post('/kiosk/submit-barcode', [RegistrationController::class, 'kiosk_submit_barcode'])->name('kiosk.submit_barcode');

//Route::post('/kiosk/submit-phone', function (){
//    return response()->json('sdffds',500);
//});

Route::post('/kiosk/submit', [RegistrationController::class, 'kiosk_submit'])->name('kiosk.submit');

Route::get('/testprint', function () {
    return view('registration.offline.print', [
        'title' => 'Print',
        'header' => "test"
    ]);
});


require __DIR__ . '/auth.php';

Route::get('/profile', function () {
    return view('profile', [
        'title' => 'Profile',
        'header' => 'Profile Member',
        // 'username' => $username
    ]);
})->middleware('auth')->name('profile');

Route::get('/survey', [SurveyController::class, 'landing'])->name('survey.landing');
Route::post('/take-survey', [SurveyController::class, 'takeSurvey'])->name('survey.takeSurvey');
Route::post('/submit-survey', [SurveyController::class, 'submitSurvey'])->name('survey.submitSurvey');
