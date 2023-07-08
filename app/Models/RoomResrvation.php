<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class RoomResrvation extends Model
{
    use HasFactory;
    protected $fillable = [
        "room_id",
        "patient_id",
        "from",
        "to",
        "is_confirmed"
    ];

    protected $casts = [
        "from" => "datetime:Y-m-d",
        "to" => "datetime:Y-m-d"
    ];

    public function room() {
        return $this->belongsTo(Room::class, "room_id");   
    }

    public function patient() {
        return $this->belongsTo(Patient::class, "patient_id");
    }



    public function isConfirmed() {
        return $this->is_confirmed == 1;
    }

    public function isExpired() {
        return now()->gt($this->to);
    }

    public function confirm() {
        $this->update(["is_confirmed" => 1]);
    }


    //scopes
    
    public function scopeOverlap(Builder $q, $start , $end)
    {
        return $q->whereDate("from", '<=', Carbon::parse($end))->whereDate("to", '>=', Carbon::parse($start));
    }

    public function scopeNotExpired(Builder $q) {
        return $q->whereDate("to", ">=", now());
    }

    public function scopeConfirmed(Builder $q) {
        return $q->where("is_confirmed", 1);
    }

}
