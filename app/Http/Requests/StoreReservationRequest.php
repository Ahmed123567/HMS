<?php

namespace App\Http\Requests;

use App\Models\Room;
use App\Models\RoomResrvation;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            "room_id" => ["required", "exists:rooms,id"],
            "patient_id" => ["required", "exists:patients,id"],
            "from" => ["required","date", "before_or_equal:to"],
            "to" => ["required","date", "after_or_equal:from"]
        ];
    }

    public function reservationIsValid() {

        return $this->reservationsInSelectedPeriod() < $this->room()->number_of_beds;
    }

    public function room() {
        
        return Room::find($this->room_id);
    }

    public function reservationsInSelectedPeriod() {

        return $this->room()->reservatoins()->confirmed()->overlap($this->from, $this->to)->count();
    }

}
