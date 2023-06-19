<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string"],
            "job_title" => ["required", "string"],
            "date_of_birth" => ["required", "date"],
            "department_id" => ["required", "integer", "exists:departmentes,id"],
            "national_id" => ['required', "integer", "min:11"],
            "user_id" => ["integer", "exists:users,id"],
            "shift_id" => ["integer"/*, "exists:shifts,id"*/]
        ];
    }
}
