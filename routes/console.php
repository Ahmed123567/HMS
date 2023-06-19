<?php

use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use App\Pipline\ToFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('casts', function () {
    $user = Patient::first();
    dd(getCarbon($user->date_of_birth, $user->date_of_birth, $user->date_of_birth)->map(fn($date) => $date->format("Y-m-d")));
})->purpose('Display an inspiring quote');






