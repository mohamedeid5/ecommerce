<?php

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;



Route::group(['namespace'=>'Dashboard', 'middleware'=>'auth:admin', 'name'=>'admin.'], function(){

    Route::get('', [DashboardController::class, 'index'])->name('admin.dashboard');

});


Route::group(['namespace'=>'Dashboard', 'middleware'=>'guest:admin','name'=>'admin.'], function(){

    Route::get('login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login_post'])->name('admin.login_post');
});
