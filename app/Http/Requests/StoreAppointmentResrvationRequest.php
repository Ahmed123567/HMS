<?php

namespace App\Http\Requests;

use App\Models\Employee;
use App\Models\Role;
use Closure;
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
            "time" => [
                "required",
                function (string $attribute, mixed $value, Closure $fail) {

                    if($this->doctor()) {
                        if ($this->doctor()->isHoliday($value)) {
                            $fail("invalid date doctor is on holiday");
                        }
    
                        if (!$this->doctor()->shift?->inShiftHours($value)) {
                            $fail("reservation time is not in shift hours");
                        }
                    }
                }
            ],
        ];
    }


    public function doctor()
    {
        return Employee::find($this->doctor_id);
    }
}
