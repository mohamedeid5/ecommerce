<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GeneralProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'is_active' => 'required',
            'slug' => 'required|unique:products,slug,'.request()->product_id,',product_id',
            'description' => 'required',
            'short_description' => 'nullable|max:500',
            'categories' => 'required|array|min:1|',
            'categories.*' => 'numeric|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'tags' => 'nullable|array|min:1',
        ];
    }
}
