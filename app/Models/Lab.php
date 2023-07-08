<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;


    protected $guarded = [];
    public function department() {
        return $this->belongsTo(Department::class, "department_id");
    }


    public function user() {
        return $this->hasOne(User::class, "employee_id");
    }

    public function reservatoins() {
        return $this->hasMany(AppointmentResrvation::class, "doctor_id");
    }

    public function patients() {
    
        return Patient::whereIn("id", $this->reservatoins()->pluck("patient_id"))->get();
    }

}
