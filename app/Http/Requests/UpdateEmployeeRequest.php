<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $this->employee->id,
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'salary' => 'required|numeric|min:0',
        ];
    }
}
