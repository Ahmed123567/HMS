<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'status',
        'clock_in',
        'clock_out',
        'late',
        'early_leaving',
        'overtime',
        'total_rest',
        'created_by',
        "total_wasted_time",
        "car_number",
        "shift_id",
        "over_in",
        "over_out"
    ];

    public function employees()
    {
        return $this->hasOne('App\Models\Employee', 'user_id', 'employee_id');
    }

    public function shift() {
        return $this->belongsTo(Shift::class, "shift_id");
    }

    public function employee()
    {
        return $this->hasOne('App\Models\Employee', 'id', 'employee_id');
    }

    public function car() {
        return $this->hasOne(Cars::class, "plate_number","car_number");
    }

    public function scopetoDay(Builder $q) {
        return $q->where("date", now()->format("Y-m-d"));
    }

    public function scopeOfDay(Builder $q, $day) {
        return $q->where("date", $day);
    }


    public function scopeWhereEmployeeCode(Builder $q, $code) {
        return $q->whereHas("employee", function ($q) use ($code) {
            return $q->where("code", $code);
        });
    }


    public function scopeFrom(Builder $q, $date) {
        return $q->whereDate("date", ">=" ,$date);
    }

    public function scopeTo(Builder $q, $date) {
        return $q->whereDate("date", "<=" ,$date);
    }

    public function isClockedIn() {
        return $this->clock_in != null;
    }

    public function isClockedOut() {
        return $this->clock_out != null;
    }

    public function clockInCarbon() {
        return Carbon::parse($this->clock_in);
    }

    public function clockOutCarbon() {
        return Carbon::parse($this->clock_out);
    }

    public function overTime() {
        return $this->over_in + $this->over_out;
    }

}
