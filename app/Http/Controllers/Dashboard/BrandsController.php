<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Upload;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\BrandsRequest;
use Illuminate\Contracts\Cache\Store;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(PAGINATION_NUMBER);

        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandsRequest $request)
    {

        DB::transaction(function () use ($request) {

            $brand = Brand::create($request->validated());

            if($request->has('image')) {

                $brand->image = Upload::upload($request->image, 'admin/images/brands');
            }

            $brand->name = $request->name;

            $brand->save();

        });

        return redirect()->route('admin.brands.index')->with(['success'=>'brand added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Method show
     *
     * @param $id $id [explicite description]
     *
     * @return void
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Method edit
     *
     * @param Brand $brand
     *
     * @return void
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandsRequest $request, $id)
    {

        DB::transaction(function () use ($request, $id) {

            $brand = $this->getBrandById($id);

            $brand->update($request->validated());

            if($request->hasFile('image')) {

                $fileName = Upload::upload($request->image, 'admin/images/brands');

                $this->deleteOldImage($brand->image);

                Storage::delete($brand->image);

                $brand->image = $fileName;

            }

            $brand->slug = Str::slug($request->slug, '-');

            $brand->name = $request->name;

            $brand->save();
        });

        return redirect()->route('admin.brands.index')->with(['success'=>'brand updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = $this->getBrandById($id);

        $brand->delete();

        $this->deleteOldImage($brand->image);

        return redirect()->route('admin.brands.index');
    }

    /**
     * Method getBrandById
     *
     * @param $id $id [explicite description]
     *
     * @return object
     */
    private function getBrandById($id)
    {
        return Brand::findOrFail($id);

    }

    /**
     * Method deleteOldImage
     *
     * @param $path
     *
     * @return void
     */
    private function deleteOldImage($path)
    {
        if(File::exists('storage/' . $path)) {

            Storage::delete($path);
        }
    }
}
