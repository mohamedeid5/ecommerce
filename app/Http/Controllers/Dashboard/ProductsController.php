<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Upload;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockRequest;
use App\Http\Requests\Admin\ImagesRequest;
use App\Http\Requests\Admin\ProductPriceRequest;
use App\Http\Requests\Admin\GeneralProductRequest;

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


    /**
     * Method price
     *
     * @param $id
     *
     * @return void
     */
    public function price($id)
    {
        $product = Product::find($id);

        return view('dashboard.products.price.create', compact('id', 'product'));
    }


    /**
     * Method storePrice
     *
     * @param ProductPriceRequest
     *
     * @return void
     */
    public function storePrice(ProductPriceRequest $request)
    {

        Product::where('id' ,$request->product_id)->update($request->except('_token', '_method', 'product_id'));

        return redirect()->route('admin.products.index')->with(['success', 'product updated successfully']);

    }

    /**
     * Method stock
     *
     * @param $id
     *
     * @return void
     */
    public function stock($id)
    {
        $product = Product::whereId($id)->first();

        return view('dashboard.products.stock.create', compact('id', 'product'));
    }

    public function storeStock(StockRequest $request)
    {
        Product::whereId($request->product_id)->update($request->except(['_token', '_method', 'product_id']));

        return redirect()->route('admin.products.index')->with(['success' => 'updated successfuly']);
    }

    /**
     * Method addImages
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function addImages($id)
    {
        $product = Product::find($id);

        return view('dashboard.products.images.create', compact('id', 'product'));
    }


   // save images to folder
    public function storeImages(Request $request)
    {
        $file = $request->file('dzfile');

        $fileName = Upload::upload($file, 'admin/images/products/' . $request->product_id);

        return response()->json([
            'name' => $fileName,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

  // save images to database
  public function storeImagesDB(ImagesRequest $request)
  {

        if ($request->has('images')) {

            foreach ($request->images as $image) {
                Image::create([
                    'imageable_id'   => $request->product_id,
                    'imageable_type' => 'App\Models\Product',
                    'image' => $image,
                ]);
            }
        }

        return redirect()->route('admin.products.index');
    }
}









