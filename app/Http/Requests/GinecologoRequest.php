<?php

namespace bagrap\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class GinecologoRequest extends FormRequest
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
        if ( $request->isMethod('PUT') || $request->isMethod('PATCH') || $request->isMethod('POST') ) {

          return [
            'ginecologo.nombre'    =>  'required',
            'ginecologo.ap_pa'     =>  'required',
            'ginecologo.ap_ma'     =>  'required',
            'ginecologo.estado'    =>  'required',
            'ginecologo.municipio' =>  'required',
            'ginecologo.direccion' =>  'required',
            'ginecologo.telefono'  =>  'required|numeric'
          ];

        }
    }

    public function messages()
    {
      return [
        'ginecologo.nombre.required'     =>  'El campo Nombre(s) es obligatorio',
        'ginecologo.ap_pa.required'      =>  'El campo Apellido Paterno es obligatorio',
        'ginecologo.ap_ma.required'      =>  'El campo Apellido Materno es obligatorio',
        'ginecologo.estado.required'     =>  'El campo Estado es obligatorio',
        'ginecologo.municipio.required'  =>  'El campo Municipio es obligatorio',
        'ginecologo.direccion.required'  =>  'El campo Dirección es obligatorio',
        'ginecologo.telefono.required'   =>  'El campo Teléfono es obligatorio',
        'ginecologo.telefono.numeric'    =>  'El campo Teléfono solo debe contener números'
      ];
    }

}
