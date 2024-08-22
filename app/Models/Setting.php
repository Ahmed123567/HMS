<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        "key",
        "value"
    ];


    
    public function scopeGetValue(Builder $q, $key) {

        return $q->where("key", "like" ,str_replace("*", "%", $key))->first()->value ?? "";
    }

    public function scopeGetValues(Builder $q, ...$keys) {

        if(count($keys) === 1) {
            return $q->where("key", "like", str_replace("*", "%", $keys))->get()->pluck("value", "key");
        }

        return $q->whereIn("keys", $keys)->get()->pluck("value", "key");
    }


}
