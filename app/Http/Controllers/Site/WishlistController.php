<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\RespondsWithHttpStatus;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use RespondsWithHttpStatus;

    public function index()
    {
        $products = auth()->user()->wishlist()->latest()->paginate(5);

        $categories = Category::all();

        return view('site.wishlist.index', compact('products', 'categories'));

    }

    /**
     * Method store
     *
     * @return void
     */
    public function store()
    {
        $productId = request('productId');

        if(!auth()->user()->wishlistHas($productId)) {

            auth()->user()->wishlist()->attach($productId);

            return $this->success('product added to wishlist successfully');
        } else {

            auth()->user()->wishlist()->detach($productId);

            return $this->success('product removed from wishlist');
        }
    }

    /**
     * Method destroy
     *
     * @param $productId
     *
     * @return void
     */
    public function destroy()
    {
        auth()->user()->wishlist()->detach(request('productId'));

        return $this->success('product removed from wishlist..');
    }
}
