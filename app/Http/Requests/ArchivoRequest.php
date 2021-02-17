<?php

namespace bagrap\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use bagrap\Rules\CheckoutRule;

class ArchivoRequest extends FormRequest
{
  protected $errorBag = 'errorsArchivos';
  
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

      // dd();

        if ( $request->isMethod('POST') ) {
          return [
            'nombre_archivo' => 'required',
            'archivo' => ['required', 'min:1', new CheckoutRule],            
          ];
        }

        elseif ( $request->isMethod('PUT') || $request->isMethod('PATCH') ) {
          return [
            'nombre_archivo' => 'required',
          ];
        }

    }

    public function messages() {
      return [
        'nombre_archivo.required' => 'El nombre del archivo es obligatorio',
        // 'archivo.required' => 'El archivo es obligatorio',
      ];
    }

}
