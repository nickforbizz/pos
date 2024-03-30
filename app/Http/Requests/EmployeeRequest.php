<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class EmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'phone' => 'required|string|max:255',
            'fk_tenant' => 'required|exists:tenants,id',
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
            'fk_tenant.required' => 'Please select a valid tenant.',
            'fk_tenant.exists' => 'The selected tenant does not exist.'
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            // 'slug' => Str::slug($this->input('name')),
            // 'created_by' => auth()->user()->id
        ]);
    }
}