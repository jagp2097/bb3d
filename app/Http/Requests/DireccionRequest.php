<?php

namespace bagrap\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class DireccionRequest extends FormRequest
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

        if ($request->isMethod('PUT') || $request->isMethod('PATCH') || $request->isMethod('POST')) {
            
            return [
                'direccion_calle' => array('required', 'regex:/[a-zA-Z0-9]/', 'max:180'),
                'direccion_numero' => 'required|digits_between:2,6',
                'direccion_codigo_postal' => 'required',
                'direccion_colonia' => array('required', 'regex:/[a-zA-Z]/', 'max:180'),
                'direccion_ciudad' => array('required', 'regex:/[a-zA-Z0-9]/', 'max:180'),
                'direccion_estado' => array('required', 'regex:/[a-zA-Z]/', 'max:180'),
                'direccion_pais' => array('required', 'regex:/[a-zA-Z]/', 'max:180')             
            ];

        }


    }
}
