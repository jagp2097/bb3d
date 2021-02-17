<?php

namespace bagrap\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
                'nombre_usuario' => 'required',
                'ap_pa_usuario' => 'required',
                'ap_ma_usuario' => 'required',
                'email_usuario' => 'required',
                'fecha_nacimiento_usuario' => 'required',
                'pais_usuario' => 'required',
                'estado_usuario' => 'required',
                'ciudad_usuario' => 'required',
                'direccion_usuario' => 'required',
                'telefono_usuario' => 'required',
                'rol_usuario' => 'required',
                'status_usuario' => 'required'
            ];
        }

    }

    public function messages()
    {
      return [
        'nombre_usuario.required' => 'El nombre es obligatorio.',
        'ap_pa_usuario.required' => 'El apellido es obligatorio.',
        'ap_ma_usuario.required' => 'El apellido es obligatorio.',
        'email_usuario.required' => 'El email es obligatorio.',
        'fecha_nacimiento_usuario.required' => 'La fecha de nacimiento es obligatori.',
        'pais_usuario.required' => 'El país es obligatorio.',
        'estado_usuario.required' => 'El estado es obligatorio.',
        'ciudad_usuario.required' => 'La ciudad es obligatoria.',
        'direccion_usuario.required' => 'La dirección es obligatoria.',
        'telefono_usuario.required' => 'El teléfono es obligatorio.',
      ];
    }

}
