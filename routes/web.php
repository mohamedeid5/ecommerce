<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
Route::get('/test', function () {

    $product = Product::find(1);

    return $product->images();

});
