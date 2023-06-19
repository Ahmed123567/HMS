<?php

namespace App\Models;

use App\Concern\HasDate;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Shift extends Model
{
    use HasFactory, HasDate;
    protected $fillable = [
        "name",
        "from",
        "to",
        "days"
    ];
    
   
    protected $casts = [
        'days' => 'collection',
        "from" => "datetime:H:i:s",
        "to" => "datetime:H:i:s",
    ];
}
