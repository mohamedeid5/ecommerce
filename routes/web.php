<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Dashboard\SmsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


        Route::group(['middleware' => 'auth'], function() {

            Route::get('profile', [ProfileController::class, 'edit'])->name('user.edit');
            Route::post('profile', [ProfileController::class, 'edit'])->name('user.update');
        });

        Route::group(['middleware' => 'guest'], function() {
            Route::get('public', function() {
                return 'not auth';
            });
        });


});
