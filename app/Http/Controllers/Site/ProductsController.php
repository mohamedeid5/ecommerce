<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $categories = Category::parent()->get();

        return view('site.products.show', compact('product', 'categories'));
    }
}
