<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
    # code...
    }

    public function store()
    {
        $productId = request('productId');

        if(!auth()->user()->wishlistHas($productId)) {
            auth()->user()->wishlist()->attach($productId);
        } else {
            auth()->user()->wishlist()->detach($productId);
        }
    }
}
