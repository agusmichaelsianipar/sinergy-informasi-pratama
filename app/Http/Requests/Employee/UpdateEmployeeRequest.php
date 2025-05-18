<?php

namespace App\Http\Requests\Employee;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
        $employee = Employee::findOrFail($this->employee_id);
        $user = User::findOrFail($employee->user_id);

        return [
            'firstname' => 'required|string|min:2|max:200',
            'lastname' => 'nullable|string|min:2|max:200',
            'email' => 'required|email|min:5|max:200|unique:users,email,'.$user->id,
            'citizenship_id_no' => 'required|numeric|min_digits:16|max_digits:16|unique:employees,citizenship_id_no,'.$employee->id,
            'citizenship_id_file' => 'nullable|image|mimes:png,jpg|max:2048',
            'date_of_birth' => 'required|date',
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            'phone' => 'required|string|min:10|max:13',
            'position' => ['required', 'string', Rule::in(Employee::POSITION)],
            'province' => 'required|numeric',
            'city' => 'required|numeric',
            'street' => 'required|string|min:5',
            'zip_code' => 'required|numeric|min:5',
            'bank_account' => ['required', 'string', Rule::in(Employee::BANK_ACCOUNT)],
            'account_number' => 'required|numeric|min_digits:8',
        ];
    }
}
