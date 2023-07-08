<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        "number_of_beds",
        "status",
        "is_special",
        "one_night_bed_price",
        "room_id",
    ];

    public function reservatoins() {
        return $this->hasMany(RoomResrvation::class, "room_id");
    }

    public function avilableBeds($from, $to) {

        $avilable = $this->number_of_beds - $this->reservatoins()->overlap($from, $to)->confirmed()->notExpired()->count();
        return max($avilable, 0);
    }

    public function priceInPeriod($from, $to) {
        [$from, $to] = getCarbon($from, $to);
        return  ($from->diffInDays($to) + 1) * $this->one_night_bed_price;
    }

    public function isSpecial() {
        return $this->is_special == 1;
    }
}
