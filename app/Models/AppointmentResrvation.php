<?php

namespace App\Models;

use Abdo\Searchable\Attributes\Search;
use Abdo\Searchable\Attributes\SearchAdd;
use Abdo\Searchable\Attributes\SearchColumns;
use Abdo\Searchable\Searchable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class AppointmentResrvation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        "doctor_id",
        "patient_id",
        "time",
        "is_confirmed",
        "is_closed"
    ];

    protected $casts = [
        "time" => "datetime",
    ];

 
    #[SearchColumns]
    protected $searchable = [
       
        "columns" => [
            "patient.name",
            "doctor.name",
            "time",
        ],
    
        "eager" => [
            "patient:id,name",
            "doctor"
        ]
    ];



    #[SearchAdd("time")]
    public function searchByDayName(Builder $q, $searchWord)
    {
        $q->orWhereRaw("DAYNAME(time) like ?", ["%". $searchWord ."%"]);
    }

    public function doctor()
    {
        return $this->belongsTo(Employee::class, "doctor_id");
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, "patient_id");
    }

    public function report()
    {
        return $this->hasOne(PatientRecord::class, "resrvation_id");
    }

    public function isConfirmed()
    {
        return $this->is_confirmed == 1;
    }

    public function isClosed()
    {
        return $this->is_closed == 1;
    }

    public function isExpired()
    {
        return now()->gt($this->day);
    }

    public function isPassed()
    {
        return getCarbon(now()->format("Y-m-d"))->gt(getCarbon($this->time->format("Y-m-d")));
    }

    public function confirm()
    {
        $this->update(["is_confirmed" => 1]);
    }

    public function close()
    {
        $this->update(["is_closed" => 1]);
    }


    //scopes

    public function scopeToday(Builder $q)
    {
        return $q->atDay(now());
    }


    public function scopeAtDay(Builder $q, $day)
    {
        return $q->whereDate("time", getCarbon($day)->format("Y-m-d"));
    }

    public function scopeConfirmed(Builder $q)
    {
        return $q->where("is_confirmed", 1);
    }

    public function scopeClosed(Builder $q)
    {
        return $q->where("is_closed", 1);
    }


    public function scopeNotClosed(Builder $q)
    {
        return $q->where("is_closed", 0);
    }

    public function scopeforAuthDoctor(Builder $q)
    {
        return $q->where("doctor_id", auth()->user()?->employee?->id);
    }

    public function scopeAt(Builder $q, $time)
    {

        $timeSlot = settings("reservation_time_slots_for_appointment");

        return $q->whereRaw("? between DATE_SUB(time, INTERVAL ? MINUTE) and date_add(time,interval ? minute)", [$time, $timeSlot, $timeSlot]);
    }
}
