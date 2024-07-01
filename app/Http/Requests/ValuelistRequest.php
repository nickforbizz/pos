<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ValuelistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();
        return $user->hasAnyRole(['superadmin']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'type' => 'required|string|max:255',
            'index' => 'required',
            'value' => 'required|string|max:255',
            // non required fields
            'active' => 'nullable|string',
        ];

        // Modify rules based on request method (create or edit)
        if ($this->method() === 'PUT') {
            // Remove domain uniqueness check for edit
            // unset($rules['domain']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'unique' => ':attribute is already used',
            'required' => 'The :attribute field is required.',
        ];
    }


    protected function prepareForValidation()
    {
        
    }
}
