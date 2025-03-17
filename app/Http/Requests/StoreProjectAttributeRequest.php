<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectAttributeRequest extends FormRequest
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
            'attributes' => 'required|array',
            'attributes.*.id' => 'exists:attributes,id',
            'attributes.*.value' => 'required'
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
            'attributes.required' => 'Attributes are required.',
            'attributes.array' => 'Attributes must be an array.',
            'attributes.*.id.exists' => 'The selected attribute ID does not exist.',
            'attributes.*.value.required' => 'The attribute value is required.',
        ];
    }
}
