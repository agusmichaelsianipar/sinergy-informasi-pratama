<?php

namespace App\Http\Requests\Employee;

use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|min:2|max:200',
            'lastname' => 'nullable|string|min:2|max:200',
            'email' => 'required|email|min:5|max:200|unique:users,email',
            'citizenship_id_no' => 'required|numeric|min_digits:16|max_digits:16|unique:employees,citizenship_id_no',
            'citizenship_id_file' => 'required|image|mimes:png,jpg|max:2048',
            'date_of_birth' => 'required|date',
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            'phone' => 'required|string|min:10|max:16',
            'position' => ['nullable', 'string', Rule::in(Employee::POSITION)],
            'province' => 'nullable|numeric',
            'city' => 'nullable|numeric',
            'street' => 'nullable|string|min:5',
            'zip_code' => 'nullable|numeric|min:5',
            'bank_account' => ['nullable', 'string', Rule::in(Employee::BANK_ACCOUNT)],
            'account_number' => 'nullable|numeric|min_digits:8',
        ];
    }
}
