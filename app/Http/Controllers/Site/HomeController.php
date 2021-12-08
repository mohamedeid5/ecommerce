<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Method home
     *
     * @return view
     */
    public function home()
    {
        $slider = Slider::get(['image'])->first();

        $categories = Category::parent()->get();

        return view('site.home', compact('slider', 'categories'));
    }
}
