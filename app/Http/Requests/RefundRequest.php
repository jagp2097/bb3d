<?php

namespace bagrap\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RefundRequest extends FormRequest
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
        return [

            'description_refund' => 'required|max:180'

        ];
    }

    public function messages()
    {
        return [

            'description_refund.required' => 'Por favor indique la causa del reembolso.', 
            'description_refund.max' => 'Solo puede escribir un máximo de 200 caracteres.' 

        ];
    }

}
