<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "room_id" => ["required"] ,
            "number_of_beds" => ["required", "integer", "not_in:0"],
            "is_special" => ["required", "in:0,1"],
            "one_night_bed_price" => ["required", "numeric"]
        ];
    }


    protected function prepareForValidation(): void
    {
        if($this?->is_special != 1) {
            $this->merge([
                'is_special' => 0,
            ]);
        }       
    }
}
