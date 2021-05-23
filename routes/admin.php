<?php

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\BrandsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\TagsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// prefix [admin]

Route::group([
    'prefix'=> LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function () {


    Route::group([
        #'namespace'=>'Dashboard',
        'middleware'=>'auth:admin',
        'as'=>'admin.',
        'prefix' => 'admin'
    ], function(){

        // logout route
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        // dashboard route
        Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');

        // settings routes
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', [SettingsController::class, 'shippingMethods'])->name('shipping.methods');
            Route::put('shipping-methods/{id}', [SettingsController::class, 'updateShippingMethods'])->name('update.shipping.methods');
        }); // end settings routes

        // profile routes

        Route::group(['prefix' => 'profile'], function(){

            Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::put('edit', [ProfileController::class, 'update'])->name('profile.update');

        }); // end profile routes

        /** categories routes */

        Route::resource('categories', CategoryController::class);

        /** brands routes */

        Route::resource('brands', BrandsController::class);

        /** tags routes */

        Route::resource('tags', TagsController::class);

        /** products routes */

        Route::get('products/general-information', [ProductsController::class, 'create'])->name('products.general.create');

        Route::post('products/general-information', [ProductsController::class, 'store'])->name('products.general.store');

        Route::resource('products', ProductsController::class);






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
