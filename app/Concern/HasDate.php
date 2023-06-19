<?php

namespace App\Concern;

use Illuminate\Support\Carbon;

trait HasDate
{

    public function __get($key)
    {

        if (str_ends_with($key, "_carbon") && $attribute = $this->parseCarbon($key)) {
            return $attribute;
        }

        return parent::__get($key);
    }

    public function parseCarbon($key)
    {
        $dateAttribute = substr($key, 0, -7);
        
        return tryThis(fn() => Carbon::parse($this->attributes[$dateAttribute]), false); 
    }
}
