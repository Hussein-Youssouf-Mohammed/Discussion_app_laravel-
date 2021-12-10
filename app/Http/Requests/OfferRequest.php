<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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

            'name' => 'required',
            'price' => 'required',
            'details' => 'required'
        ];
    }


    public function messages() {

        return [


            'name.required' => __('measseg.offer name required'),
            'name.unique' => __('measseg.offer name  unique'),
            'price.required' => __('measseg.price required'),
            'details.required' => __('measseg.details required'),
        ];
    }
}
