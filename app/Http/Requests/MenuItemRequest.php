<?php

namespace App\Http\Requests;

use App\Models\MenuItem;
use Composer\DependencyResolver\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuItemRequest extends FormRequest
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
        $rules =  [
            'name' =>  ['required'],
            'module' => 'nullable',
            'icon'   => 'nullable',
            'type'   => 'required|string',
            'target' => 'required',
            'active_resolver' => 'nullable',
            'menu_id' => 'required'
        ];
        if(!$this->custom_value){
            $rules += ['value1' => 'required'];

        }

        if(!$this->value1){
            $rules += ['custom_value' => 'required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'custom_value.required' => 'The '.$this->type. ' field is required',
            'type.required' => 'The type field is required',
            'target.required' => 'The target field is required',
            'name.required' => 'The name field is required',
            'value1.required' => 'The '.$this->type. ' field is required',
        ];
    }
}
