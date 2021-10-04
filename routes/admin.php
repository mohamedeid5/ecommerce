<?php

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\BrandsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\OptionsController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\TagsController;
use App\Http\Controllers\Dashboard\VariationsController;
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

        Route::resource('products', ProductsController::class);

        Route::prefix('products')->group(function () {

            // price
            Route::get('price/{id}', [ProductsController::class, 'price'])->name('products.price');
            Route::post('price', [ProductsController::class, 'storePrice'])->name('products.price.store');

            // stock
            Route::get('stock/{id}', [ProductsController::class, 'stock'])->name('products.stock');
            Route::post('stock', [ProductsController::class, 'storeStock'])->name('products.stock.store');

            // images
            Route::get('images/{id}', [ProductsController::class, 'addImages'])->name('products.images');
            Route::post('images', [ProductsController::class, 'storeImages'])->name('products.images.store');
            Route::post('images/db', [ProductsController::class, 'storeImagesDB'])->name('products.images.store.db');

        });

        // variations
        Route::resource('variations', VariationsController::class);

        // options
        Route::resource('options', OptionsController::class);



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
