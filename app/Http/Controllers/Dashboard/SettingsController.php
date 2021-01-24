<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * get methods settings from database
     *
     * @param $type
     *
     */
    public function shippingMethods($type)
    {
        $methods = [
            'free-shipping' => 'free_shipping_label',
            'local-shipping' => 'local_label',
            'outer-shipping' => 'outer_label',
        ];

        key_exists($type, $methods) ? $type : abort(404);

        $method = Setting::where('key', $methods[$type])->first();

        return view('dashboard.settings.shippings.edit', compact('method'));
    }

    public function updateShippingMethods(Request $request, $id)
    {

    }
}
