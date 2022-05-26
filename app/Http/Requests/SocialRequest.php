<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        /*if (auth()->user()->role('admin')){
            return true;
        }else{
            return false;
        }*/
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>  ['required', 'string', 'max:200'],
            'link' => ['required','url'],
            'icon' => ['nullable','string','max:30'],
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array
     */
   /* public function messages()
    {
        return [
            'fiscal_year_name.required'=> '',
        ];
    }*/
}
