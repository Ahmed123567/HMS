<?php

namespace App\Models;

use Abdo\Searchable\Attributes\Search;
use Abdo\Searchable\Attributes\SearchAdd;
use Abdo\Searchable\Attributes\SearchColumns;
use Abdo\Searchable\Searchable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        "diagnosis",
        "description",
        "files",
        "resrvation_id",
    ];

    protected $casts = [
        "files" => "collection"
    ];

    #[SearchColumns]
    protected $searchable = [
        "columns" => [
            'diagnosis',
            'description',
            'resrvation.doctor.name',
            'resrvation.doctor.department.name',
        ],

        "eager" => [
            "resrvation.doctor.department"
        ]
    ];


    public function resrvation()
    {
        return $this->belongsTo(AppointmentResrvation::class, "resrvation_id");
    }
}
