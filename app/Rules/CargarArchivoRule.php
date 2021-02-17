<?php

namespace bagrap\Rules;

use Illuminate\Contracts\Validation\Rule;

class CargarArchivoRule implements Rule
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

        $sizeArr = sizeof($value);
        $com = 0;

        foreach($value as $val) {

            if(is_object($val)) {
                if ($val->getClientOriginalExtension() == "vol" || $val->getClientOriginalExtension() == "jpg") {
                    $com = $com + 1;
                }
            }

            if(is_string($val)) {
                $com = $com + 1;

            }

        }

        return $sizeArr == $com ? true : false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Por favor, solo cargue archivos .vol o .jpg';
    }
}
