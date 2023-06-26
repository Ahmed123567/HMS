<?php

use App\Exceptions\InternalServerError;
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


}
