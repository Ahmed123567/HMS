<?php

namespace App\Models;

use App\Concern\HasDate;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Employee extends Model
{
    use HasFactory, HasDate;

    protected $fillable = [
        "name",
        "date_of_birth",
        "gender",
        "job_title",
        "national_id",
        "shift_id",
        "department_id"
    ];

    public function age() {
        return now()->diffInYears($this->date_of_birth_carbon);
    }

    public function department() {
        return $this->belongsTo(Department::class, "department_id");
    }

    public function shift() {
        return $this->belongsTo(Shift::class, "shift_id");
    }
    
    public function user() {
        return $this->hasOne(User::class, "employee_id")->employees();
    }

    public function reservatoins() {
        return $this->hasMany(AppointmentResrvation::class, "doctor_id");
    }

    public function patients() {
    
        return Patient::whereIn("id", $this->reservatoins()->pluck("patient_id"))->get();
    }

    public function isHoliday($day) {
        
        $day = strtolower(getCarbon($day)->format("l"));
        return $this->shift->days->doesntContain($day);
    }



    public function scopeManagers(Builder $q) {
        return $q->with("user")->whereHas("user", function ($q) {
            return $q->managers();
        });
    }
    
    public function scopeDoctors(Builder $q) {
        return $q->with("user")->whereHas("user", function ($q) {
            return $q->doctors();
        });
    }

    public function scopeUnderDepartment(Builder $q, $departmentId) {
        return $q->whereHas("department", fn ($q) => $q->whereId($departmentId));
    }

    public function managedDepartment() {
        return $this->hasOne(Department::class, "manager_id");
    }

    public function scopeDosentHaveAccount(Builder $q) {
        return $q->doesntHave("user");
    }
}
