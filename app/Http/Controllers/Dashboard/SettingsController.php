<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingsRquest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * @param ShippingsRquest $request
     * @param $id
     * @return
     */
    public function updateShippingMethods(ShippingsRquest $request, $id)
    {

        DB::transaction(function () use ($request, $id) {

            $shipping_method = Setting::find($id);

            $shipping_method->plain_value = $request->plain_value;

            // save translations
            $shipping_method->value = $request->value;

            $shipping_method->save();

        });

        return redirect()->back();
    }
}
