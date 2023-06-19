<?php

namespace App\Http\Requests;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAppointmentResrvationRequest extends FormRequest
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
            "doctor_id" => ["required", "exists:employees,id"],
            "patient_id" => ["required", "exists:patients,id"],
            "time" => ["required"],
        ];
    }

    public function isRequestDayValid() {
        return  Employee::find($this->doctor_id)->isHoliday($this->time);
    }
}
