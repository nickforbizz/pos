<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class OrderRequest extends FormRequest
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
            'order_date' => 'required',
            'fk_tenant' => 'required|exists:tenants,id',
            'fk_employee' => 'required|exists:employees,id',
            'fk_customer' => 'required|exists:customers,id',

            // non required fields
            'total_amount' => 'nullable|string',
            'status' => 'nullable|string',
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
            'exists' => 'The selected :attribute does not exist.'
        ];
    }


    protected function prepareForValidation()
    {
        $fk_tenant = $this->input('fk_tenant');
        if (!auth()->user()->hasAnyRole(['superadmin'])) {
            $fk_tenant = auth()->user()->fk_tenant;
        }
        $this->merge([
            // 'slug' => Str::slug($this->input('name')),
            'fk_tenant' => $fk_tenant,
        ]);
    }
}
