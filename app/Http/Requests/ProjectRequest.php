<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $rules = [];

        switch ($this->method()) {
            case 'POST': // Store a new project
                $rules = [
                    'name' => 'required|string',
                    'status' => 'required|in:active,inactive,completed',
                ];
                break;

            case 'PUT': // Update an existing project
            case 'PATCH':
                $rules = [
                    'name' => 'sometimes|string',
                    'status' => 'sometimes|in:active,inactive,completed',
                ];
                break;

            case 'GET': // Filter projects
                $rules = [
                    'filters' => 'array',
                    'filters.*' => 'string',
                    'filters.*.*' => 'string',
                ];
                break;
        }

        return $rules;
    }

    /**
     * Customize the error messages.
     */
    public function messages()
    {
        return [
            'name.required' => 'Project name is required.',
            'name.string' => 'Project name must be a valid string.',
            'status.required' => 'Project status is required.',
            'status.in' => 'Status must be one of: active, inactive, completed.',
            'filters.array' => 'Filters should be an array.',
            'filters.*.string' => 'Each filter field must be a string.',
            'filters.*.*.string' => 'Filter values must be strings.',
        ];
    }
}
