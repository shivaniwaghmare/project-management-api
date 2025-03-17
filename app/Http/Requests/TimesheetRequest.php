<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimesheetRequest extends FormRequest
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
            case 'POST': // Store a new timesheet
                $rules = [
                    'project_id' => 'required|exists:projects,id',
                    'user_id' => 'required|exists:users,id',
                    'hours' => 'required|numeric|min:0',
                    'date' => 'required|date',
                    'description' => 'nullable|string|max:255',
                ];
                break;

            case 'PUT': // Update an existing timesheet
            case 'PATCH':
                $rules = [
                    'project_id' => 'sometimes|exists:projects,id',
                    'user_id' => 'sometimes|exists:users,id',
                    'hours' => 'sometimes|numeric|min:0',
                    'date' => 'sometimes|date',
                    'description' => 'nullable|string|max:255',
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
            'project_id.required' => 'Project ID is required.',
            'project_id.exists' => 'The selected project does not exist.',
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'hours.required' => 'Hours are required.',
            'hours.numeric' => 'Hours must be a number.',
            'hours.min' => 'Hours must be at least 0.',
            'date.required' => 'Date is required.',
            'date.date' => 'Invalid date format.',
            'description.string' => 'Description must be a string.',
            'description.max' => 'Description may not be greater than 255 characters.',
        ];
    }
}
