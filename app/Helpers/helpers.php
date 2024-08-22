<?php

use App\Exceptions\InternalServerError;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

if (!function_exists("tryThis")) {
    function tryThis(Closure $callback, $exceptionHappend = null)
    {
        try {
            return $callback();
        } catch (Throwable $e) {

            if (is_null($exceptionHappend) && env("APP_DEBUG")) {
                throw $e;
            }

            report($e);

            if ($exceptionHappend instanceof Closure) {

                return $exceptionHappend($e);
            }

            return $exceptionHappend;
        }
    }

}


if (!function_exists("getCarbon")) {
    function getCarbon(...$dates)
    {
        return count($dates) === 1
            ? Carbon::parse($dates[0])
            : collect($dates)->map(fn ($date) => Carbon::parse($date));
    }
}

if (!function_exists("defaultImage")) {
    function defaultImage()
    {
        return 'storage/images/default.jpg';
    }
}



if (!function_exists('settings')) {
    function settings($keys)
    {

        if (is_string($keys) && !str_contains($keys, "*")) {
            return Setting::getValue($keys);
        }

        return Setting::getValues($keys);
    }
}


if (!function_exists('setSettings')) {
    function setSettings(array $settings)
    {
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(["key" => $key], ["value" => $value]);
        }
    }
}

if (!function_exists('settingGetJson')) {
    function settingGetJson(string $key)
    {
        return json_decode(Setting::getValue($key), true) ?? [];
    }
}


if(!function_exists("explodeByLastDelimiter")) {
    function explodeByLastDelimiter($string, $delim) {
        
        $reversedParts = explode($delim, strrev($string), 2);
        $result = [strrev($reversedParts[1]), strrev($reversedParts[0])];
        return $result; 
    }
}