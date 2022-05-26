<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $id = $this->page->id ?? null;

        $rules = [
//            'title' => 'required|string|max:255|unique:pages,title,' . $id,
            'title'  => 'required|string|max:255',
            'body'   => 'required|array|min:1',
            'body.*' => 'required',
        ];

        return $rules;
    }
}
