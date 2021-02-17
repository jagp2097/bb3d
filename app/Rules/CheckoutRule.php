<?php

namespace bagrap\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckoutRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        
        return $value->getClientOriginalExtension() == "vol" || $value->getClientOriginalExtension() == "jpg";
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute debe ser un archivo .vol o .jpg';
    }
}
