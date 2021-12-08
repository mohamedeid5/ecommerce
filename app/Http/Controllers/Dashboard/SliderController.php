<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Upload;
use App\Http\Requests\Admin\SliderImagesRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Method create
     *
     * @return view
     */
    public function create()
    {
        $images = Slider::get(['image']);

        return view('dashboard.slider.create', compact('images'));
    }

    /**
     * Method store
     *
     * @param Request $request
     *
     * @return response
     */
    public function store(Request $request)
    {
        $file = $request->file('dzfile');

        $fileName = Upload::upload($file, 'admin/images/slider');

        return response()->json([
            'name' => $fileName,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /**
     * Method storeImagesDB
     *
     * @param SliderImagesRequest $request
     *
     * @return redirect
     */
    public function storeImagesDB(SliderImagesRequest $request)
    {
        if($request->has('images')) {
            foreach($request->images as $image) {

                Slider::create([
                    'image' => $image,
                ]);

            }
        }

        return redirect()->back();
    }

}
