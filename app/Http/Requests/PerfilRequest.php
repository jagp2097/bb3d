<?php

namespace bagrap\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
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
    public function rules()
    {
        return [
          'perfil_correo'      => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::id())],
          'perfil_nombre'      => 'required|string|max:255',
          'perfil_apellidos'   => 'required|string|max:255',
          'perfil_nacimiento'  => 'required|string|max:50',
          'perfil_pais_origen' => 'required|string|max:50',
          'perfil_telefono'    => 'required|max:25',
          'perfil_foto'        => 'image',
        ];
    }

    public function messages()
    {
        return [

            'perfil_correo.required' => "El campo Correo electrónico es obligatorio",
            'perfil_correo.email' => "Introduzca una dirección de Correo electrónico valida",
            'perfil_nombre.required' => "El campo Nombre es obligatorio",
            'perfil_apellidos.required' => "El campo Apellidos es obligatorio",
            'perfil_nacimineto.required' => "El campo Fecha de nacimiento es obligatorio",
            'perfil_pais_origen.required' => "El campo País de origen es obligatorio",
            'perfil_telefono.required' => "El campo Teléfono es obligatorio",
            'perfil_foto.image' => "Debe subir una imagen con extención jpeg, png, bmp, gif o svg",

        ];
    }

}
