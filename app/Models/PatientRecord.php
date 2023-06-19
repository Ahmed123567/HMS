<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        "diagnosis",
        "description",
        "files",
        "resrvation_id",
    ];

    protected $casts = [
        "files" => "array"
    ];

    public function resrvation() {
        return $this->belongsTo(AppointmentResrvation::class, "resrvation_id");
    }
}
