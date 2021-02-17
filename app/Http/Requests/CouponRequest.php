<?php

namespace bagrap\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CouponRequest extends FormRequest
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

            'cupon_codigo' => 'required|unique:coupons,codigo',
            'tipo_cupon' => 'required',
            'date_vencimiento' => 'required',
            
        ];
    }
}
