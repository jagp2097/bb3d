<?php

namespace bagrap\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class PaqueteRequest extends FormRequest
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
        if ($request->isMethod('POST')) {
            return [
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio' => 'required|numeric',
                'foto' => 'required|image',
                'publicado' => 'required',
                'entregable' => 'required'
            ];
        }

        elseif ($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            return [
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio' => 'required|numeric',
                'foto' => 'nullable|image',
                'publicado' => 'required',
                'entregable' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo Nombre del paquete es obligatorio',
            'descripcion.required' => 'El campo Descripción del paquete es obligatorio',
            'precio.required' => 'El campo Precio del paquete es obligatorio',
            'precio.numeric' => 'El campo Precio solo debe contener números',
            'foto.required' => 'El campo Foto del paquete es obligatorio',
            'foto.image' => 'El formato de la imagen no es admitido',
            'publicado.required' => 'Seleccione si el paquete será publicado o no',
            'entregable.required' => 'Seleccione si el paquete tendrá que ser enviado o no',
        ];
    }
}