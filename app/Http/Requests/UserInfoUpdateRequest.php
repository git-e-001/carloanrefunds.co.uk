<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoUpdateRequest extends FormRequest
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
        $id = auth()->id() ?? null;
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|min:8',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
            'address' => 'required|string|max:255',
            'image' => 'nullable|image',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '"Name"',
            'phone' => '"Mobile Number"',
            'email' => '"Email"',
            'address' => '"Address"',
            'image' => '"Profile Picture"',
        ];
    }
}
