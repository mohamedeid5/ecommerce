<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\Site\VerificationCodeController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Dashboard\SmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('sms', [SmsController::class, 'index'])->name('sms.index');
Route::post('sms', [SmsController::class, 'send'])->name('sms.send');

Route::get('/', function () {
    return view('site.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//Auth::routes(['verify' => true]);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){

        // auth users
        Route::group(['middleware' => 'auth'], function() {

            // general routes
            Route::get('profile/general', [ProfileController::class, 'general'])->name('profile.general');
            Route::put('profile/general', [ProfileController::class, 'generalStore'])->name('profile.general.update');

            // mobile routes
            Route::get('profile/mobile', [VerificationCodeController::class, 'index'])->name('profile.mobile');
            Route::post('profile/mobile/send-code', [VerificationCodeController::class, 'sendCode'])->name('profile.mobile.send.code');
            Route::post('profile/mobile/check-code', [VerificationCodeController::class, 'verify'])->name('profile.mobile.recive.code');

        });

        // guest users
        Route::group(['middleware' => 'guest'], function() {
            Route::get('public', function() {
                return 'not auth';
            });
        });


});
