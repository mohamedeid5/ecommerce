<?php

namespace App\Rules\Admin;

use App\Models\VariationTranslation;
use Illuminate\Contracts\Validation\Rule;

class VariationUniqueName implements Rule
{

    public $variation_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->variation_id = $id;
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

        // edit form
        if($this->variation_id) {
            $variation = VariationTranslation::where($attribute, $value)->where('variation_id', '!=', $this->variation_id)->first();

        } else { // create form
            $variation = VariationTranslation::where($attribute, $value)->first();
        }


        if($variation) {
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
        return 'This name already exists';
    }
}
