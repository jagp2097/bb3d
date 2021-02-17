<?php

namespace bagrap\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class AlbumRequest extends FormRequest
{
  protected $errorBag = 'errorsAlbumes';

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
            'nombre_album' => 'required|max:20',
            'descripcion'  => 'required|max:25',
          ];

        }
    }

    public function messages()
    {
      return [
        'nombre_album.required' => 'El nombre del albúm es obligatorio.',
        'nombre_album.max' => 'El nombre del álbum no puede tener más de 20 caracteres.',
        'descripcion.required' => 'La descripcón del albúm es obligatoria.',
        'descripcion.max' => 'La descripción del álbum no puede tener más de 25 caracteres.',
      ];
    }
}
