<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoRequest extends FormRequest
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
            'page_id' => 'required',
            'page_title'=> 'nullable',
            'page_description' => 'nullable',
            'page_keywords' => 'nullable',
            'og_title' => 'nullable',
            'og_type' => 'nullable',
            'og_url' => 'nullable',
            'og_description' => 'nullable',
            'og_image' => 'nullable',
            'twitter_title' => 'nullable',
            'twitter_site' => 'nullable',
            'twitter_card' => 'nullable',
            'twitter_description' => 'nullable',
            'twitter_image' => 'nullable',
            'page_scripts' => 'nullable',
        ];
    }
}
