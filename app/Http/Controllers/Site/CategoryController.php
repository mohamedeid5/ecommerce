<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Method productBySlug
     *
     * @param $slug
     *
     * @return view
     */
    public function productBySlug($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $products = $category->products;

        $categories = Category::parent()->get();

       return view('site.products.index', compact('products', 'category', 'categories'));
    }
}
