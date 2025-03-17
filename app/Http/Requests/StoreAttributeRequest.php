<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:attributes,name',
            'type' => 'required|in:text,date,number,select'
        ];
    }

     /**
     * Customize the error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The attribute name is required.',
            'name.string' => 'The attribute name must be a string.',
            'name.unique' => 'An attribute with this name already exists.',
            'type.required' => 'The attribute type is required.',
            'type.in' => 'The attribute type must be one of: text, date, number, select.',
        ];
    }
}
