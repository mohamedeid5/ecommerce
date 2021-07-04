<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductPriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price'                 => 'required|min:0|numeric',
            'product_id'            => 'required|exists:products,id',
            'speical_price'         => 'nullable|numeric',
            'speical_price_type'    => 'required_with:speical_price|in:fixed,percent',
            'speical_price_start'   => 'required_with:speical_price|date_format:Y-m-d',
            'speical_price_end'     => 'required_with:speical_price|date_format:Y-m-d',

        ];
    }
}
