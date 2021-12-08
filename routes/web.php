<?php

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\ProductsController;
use App\Http\Controllers\Site\VerificationCodeController;
use App\Http\Controllers\Site\WishlistController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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

        });


        // home route
        Route::get('/', [HomeController::class, 'home'])->name('home');

        // categories routes
        Route::get('category/{slug}',  [CategoryController::class, 'productBySlug'])->name('category');

        // product routes
        Route::get('/{slug}', [ProductsController::class, 'show'])->name('product.show');

        // wishlist routes
        Route::get('wishlist', [WishlistController::class, 'show'])->name('wishlist');

        Route::get('wishlist/{productId}', [WishlistController::class, 'store'])->name('wishlist.store');

});
