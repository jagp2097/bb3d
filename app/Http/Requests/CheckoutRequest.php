<?php

namespace bagrap\Http\Requests;

// use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
// use bagrap\Rules\CheckoutRule;

class CheckoutRequest extends FormRequest
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

        if ($request->filled('direccion')) 
        {
            $rules = [

                'direccion' => "required",
                'pedido_estado' => "nullable|string",
                'pedido_codigo_postal' => "nullable|numeric",
                'pedido_colonia' => "nullable|string",
                'pedido_calle' => "nullable|string",
                'pedido_numero' => "nullable|numeric",
                'pedido_ciudad' => "nullable|string",
                'pedido_referencia_direccion' => "nullable",

            ];

        } else {

            $rules = [
                
                'pedido_estado' => "required|string",
                'pedido_ciudad' => "required|string",
                'pedido_codigo_postal' => "required|numeric",
                'pedido_colonia' => "required|string",
                'pedido_calle' => "required|string",
                'pedido_numero' => "required|numeric",
                'pedido_referencia_direccion' => "required",
                
                // required_if:list_type,==,For Sale
            ];

        }

        // dd($rules);
        
        return $rules;
        
    }
    
    public function messages()
    {
        
        return [

            'archivo.required' => "Por favor, cargue un archivo",
            'card.required' => 'Seleccione una de sus tarjetas guardadas.',
            
        ];
        
    }    

}
