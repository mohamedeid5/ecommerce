<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Admin\ProductQty;

class StockRequest extends FormRequest
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
            'sku'          => 'nullable',
            'product_id'   => 'required|exists:products,id',
            'manage_stock' => 'required|in:0,1',
            'in_stock'     => 'required|in:0,1',
            'qty'          => new ProductQty(request())
        ];
    }
}
