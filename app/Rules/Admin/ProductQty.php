<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ProductQty implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //return $this->request->manage_stock == 0 or $this->request->manage_stock == 1 and $value != '';

        if ($this->request->manage_stock ==  1 && $value == null) {
            return false;
        } else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute cant not be null';
    }
}
