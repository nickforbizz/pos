<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();
        return $user->hasRole('superadmin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'guard_name' => 'required|min:2',
        ];
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
        // do something before validation
    }


    public function passedValidation()
    {
        $this->merge([
            // 'created_by' => Auth::id()
        ]);
    }
}
