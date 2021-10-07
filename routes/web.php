<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
Route::get('/test', function () {

    $product = Product::query()
    ->join('products', 'product_images.product_id', '=', 'products.id')
    ->selectRaw('products.qty')
    ->groupByRaw('products.id')
    ->get();

    return $product;


});
