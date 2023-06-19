<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentResrvation extends Model
{
    use HasFactory;
    protected $fillable = [
        "doctor_id",
        "patient_id",
        "day",
        "time",
        "is_confirmed",
        "is_closed"
    ];

    protected $casts = [
        "time" => "datetime",
    ];

    public function doctor() {
        return $this->belongsTo(Employee::class, "doctor_id");   
    }

    public function patient() {
        return $this->belongsTo(Patient::class, "patient_id");
    }

    public function report() {
        return $this->hasOne(PatientRecord::class, "resrvation_id");
    }

    public function isConfirmed() {
        return $this->is_confirmed == 1;
    }

    public function isClosed() {
        return $this->is_closed == 1;
    }

    public function isExpired() {
        return now()->gt($this->day);
    }

    public function confirm() {
        $this->update(["is_confirmed" => 1]);
    }

    public function close() {
        $this->update(["is_closed" => 1]);
    }


    //scopes
    
    public function scopeToday(Builder $q)
    {
        return $q->atDay(now());
    }


    public function scopeAtDay(Builder $q, $day)
    {
        return $q->whereDate("time",getCarbon($day)->format("Y-m-d"));
    }

    public function scopeConfirmed(Builder $q) {
        return $q->where("is_confirmed", 1);
    
    }
   
    public function scopeClosed(Builder $q) {
        return $q->where("is_closed", 1);
    }

    public function scopeforAuthDoctor(Builder $q) {
        return $q->where("doctor_id", auth()->user()?->employee?->id);
    }

}
