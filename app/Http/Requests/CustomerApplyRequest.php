<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerApplyRequest extends FormRequest
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

//        dd($this->request->all());

        $rules = [
            'title' => 'required',
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'middle_names' => 'string|nullable',
            'dob' => 'required|date',

            'previous_first_name' => 'required_if:is_loan_preview_name,1',
            'previous_last_name' => 'required_if:is_loan_preview_name,1',

            'email' => 'required|email|confirmed',

            'telephone_home' => 'numeric|digits:11|nullable',
            'telephone_work' => 'numeric|digits:11|nullable',
            'telephone_mobile' => 'required|numeric|digits:11',

            'in_iva' => 'required|boolean',
            'in_dmp' => 'required|boolean',
            'should_be_aware' => 'required|boolean',
        ];

        return $rules;
    }
}
