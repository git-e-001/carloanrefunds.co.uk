<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
            'name' => "required|string|max:30",
            'email' => 'required|email|unique:admins,email,'.Auth::user()->id,
            'profile_image' => 'nullable|mimes:jpg,jpeg,bmp,png|max:2024',
        ];
    }
}
