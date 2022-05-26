<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
//        $id    = $this->slider->id ?? null;
        $rules = [
            'title'       => 'required|string|max:255',
//            'title'       => 'required|string|max:255|unique:sliders,title,' . $id,
            'btn_link'    => 'nullable|url',
            'btn_color'   => 'nullable|string',
            'description' => 'nullable|string',
        ];

        if (request()->isMethod('post')) {
            $rules['image'] = 'required|image|max:2024';
        }

        if (request()->isMethod('put') || request()->isMethod('patch')) {
            $rules['image'] = 'nullable|image|max:2024';
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => '"Title"',
            'image' => '"Image"',
        ];
    }
}
