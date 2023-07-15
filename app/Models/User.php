<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Concern\HasDate;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasDate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "phone_number",
        "image",
        "role_id",
        "employee_id",
        "patient_id"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public static function boot() {
        parent::boot();
        static::creating(function($user) {
            $user->password = Hash::make($user->password);
        });

        static::updating(function($user) {
            if(!empty(request()->password)) {
                $user->password = Hash::make($user->password);
            }
        });
    }


    public function role() : BelongsTo {
        return $this->belongsTo(Role::class, "role_id");
    }

    public function hasRole(...$roles) {
        return collect($roles)->map("strtolower")->contains(strtolower($this->role->name));
    }

    public function assignRole(string|int $role) : void {
        
        if(is_string($role)) {
            $role = Role::where("name", $role)->first()?->id;
        }
        
        if(!$role || !Role::find($role)) {
            throw new Exception("role dosent exits");
        }

        $this->update(["role_id", $role]);
        
    }

    public function employee() {
        
        return $this->belongsTo(Employee::class, "employee_id");
    }


    public function patient() {
        
        return $this->belongsTo(Patient::class, "employee_id");
    }

    public function scopeManagers(Builder $q) {
        return $q->with("role")->whereHas("role", function($q){
            return $q->where("name", Role::MANAGER);
        });
    }
   
    public function scopeDoctors(Builder $q) {
        return $q->with("role")->whereHas("role", function($q){
            return $q->where("name", Role::DOCTOR);
        });
    }


    public function scopePatients(Builder $q) {
        return $q->with("role")->whereHas("role", function($q){
            return $q->where("name", Role::PATIENT);
        });
    }

    public function scopeEmployees(Builder $q) {
        return $q->with("role")->whereHas("role", function($q){
            return $q->where("name", "!=", Role::PATIENT);
        });
    }

    public function isManager() {
        return Str::lower($this->role->name) == Role::MANAGER;
    }

    public function isAdmin() {
        return Str::lower($this->role->name) == Role::ADMIN;
    }

    public function isDoctor() {
        return Str::lower($this->role->name) == Role::DOCTOR;
    }

    public function isPatient() {
        return  Str::lower($this->role->name) == Role::PATIENT;
    }

    public function isReceptionist() {
        return  Str::lower($this->role->name) == Role::RECEPTIONIST;
    }

    public function isLabAnalyst() {
        return $this->role->name == Role::LAB_ANALYST;
    }

   
    public function managedDepartment() {
        if( !$this->isManager() ) {
            return null;
        }
        return $this->employee->managedDepartment;
    }

    public function person() {
        if($this->role?->isPatient()) {
            return $this->patient?->name;
        }
        return $this->employee?->name;
    }

    public function imageUrl() {
        return 'storage/images/' . ( $this->image ?? "default.jpg" ) ;
    }

    public function imageStorePath() {
        return storage_path('app/public/images/' . $this->image);
    }
}
