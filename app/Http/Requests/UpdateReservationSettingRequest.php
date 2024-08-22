<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationSettingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "reservation_patient_reservation_limit_per_day" => ["required", "integer", "min:1"],
            "reservation_is_reservation_at_the_same_time_allowed" => ["required", "in:0,1"],
            "reservation_time_slots_for_appointment" => ["required", "integer", "min:1"]
        ];
    }
}
