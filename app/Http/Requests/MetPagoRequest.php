<?php

namespace bagrap\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class MetPagoRequest extends FormRequest
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
    public function rules(Request $request)
    {
        
        if (!$request->filled('card') && $request->input("holder_name") == null || $request->input("card_number") == null || 
            $request->input("expiration_month") == null || $request->input("expiration_year") == null || $request->input("cvv2") == null) 
        {

            $rules = [
                'card' => 'required',
            ];

            return $rules;

        }

        else {

            $rules = [

                "holder_name" => 'required',
                "card_number" => 'required',
                "expiration_month" => 'required',
                "expiration_year" => 'required',
                "cvv2" => 'required',

            ];

            return $rules;


        }

    }

    public function messages()
    {
      return [
        'holder_name.required' => 'El nombre en que aparece en la tarjeta es obligatorio.',
        'card_number.required' => 'El número de la tarjeta es obligatorio.',
        'expiration_month.required' => 'El mes de expiración es obligatorio.',
        'expiration_year.required' => 'La maño de expiración es obligatori.',
        'cvv2.required' => 'El código de seguridad es obligatorio.',
      ];
    }
}
