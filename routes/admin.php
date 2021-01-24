<?php

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SettingsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// prefix [admin]

Route::group([
    'prefix'=> LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function () {


    Route::group([
        'namespace'=>'Dashboard',
        'middleware'=>'auth:admin',
        'name'=>'admin.',
        'prefix' => 'admin'
    ], function(){

        Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', [SettingsController::class, 'shippingMethods'])->name('admin.shipping.methods');
            Route::put('shipping-methods/{id}', [SettingsController::class, 'updateShippingMethods'])->name('admin.update.shipping.methods');
        }); // end settings routes

    }); // end admin routes


    Route::group([
        'namespace'=>'Dashboard',
        'middleware'=>'guest:admin',
        'name'=>'admin.',
        'prefix' => 'admin'
    ], function(){

        Route::get('login', [LoginController::class, 'login'])->name('admin.login');
        Route::post('login', [LoginController::class, 'login_post'])->name('admin.login_post');

    }); // end login routes


}); // end localization routes
