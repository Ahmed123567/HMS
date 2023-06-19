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
        $reservationsInSelectedPeriod = RoomResrvation::overlap($this->from, $this->to)
                                                    ->whereRoomId($this->room_id)
                                                    ->confirmed()
                                                    ->count();

        $room = Room::find($this->room_id);

        if($reservationsInSelectedPeriod >= $room->number_of_beds ) {
            return false;
        }

        return true;
    }
}
