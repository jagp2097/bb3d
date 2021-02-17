<?php

namespace bagrap\Http\Requests;

use Cart;
use Illuminate\Http\Request;
use bagrap\Rules\CargarArchivoRule;
use Illuminate\Foundation\Http\FormRequest;


class PagoRequest extends FormRequest
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

        // dd($request->all());

        return [

            // 'archivo' => 'required|array|min:1|mimes:vol|size:'.sizeof(session()->get('carrito'))
            'archivo' => ['required', 'array', 'min:1', 'size:'.sizeof(session()->get('carrito')), new CargarArchivoRule]
            
        ];
    }

    public function messages()
    {
        
        return [

            'archivo.required' => "Por favor, cargue un archivo para cada producto",
            'archivo.size' => "Por favor, cargue un archivo para cada producto",
            
        ];
        
    }

}
