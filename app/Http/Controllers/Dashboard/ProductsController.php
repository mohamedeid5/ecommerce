<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralProductRequest;
use App\Http\Requests\Admin\ProductPriceRequest;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(PAGINATION_NUMBER);

        return view('dashboard.products.general.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];

        $data['brands'] = Brand::isActive()->select('id')->with('translations')->get();

        $data['tags']   = Tag::select('id')->get();

        $data['categories'] = Category::isActive()->select('id')->get();

        return view('dashboard.products.general.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneralProductRequest $request)
    {
        DB::transaction(function () use ($request) {

            $product = Product::create($request->only('slug', 'brand_id', 'is_active'));

            // save translations
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            //save product categories
            $product->categories()->attach($request->categories);

            // save product tags
            $product->tags()->attach($request->tags);
        });

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.products.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function price($id)
    {
        return view('dashboard.products.price.create', compact('id'));
    }

    public function storePrice(ProductPriceRequest $request)
    {
        return $request;
    }
}
