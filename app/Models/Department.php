<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "manager_id"
    ];

    protected $table = "departmentes";

    public function employees() {
        return $this->hasMany(Employee::class, "department_id");
    }

    public function manager() {
        return $this->belongsTo(Employee::class, "manager_id");
    }
}
