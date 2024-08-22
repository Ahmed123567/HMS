<?php

use App\Models\AppointmentResrvation;
use App\Models\Patient;
use App\Models\PatientRecord;
use App\Models\Room;
use App\Models\User;
use App\Pipline\ToFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
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
   User::where("id", "!=", 0)->update(["password" => Hash::make(123)]);
})->purpose('Display an inspiring quote');


Artisan::command('i', function () {
 
   $res = PatientRecord::search("Medicin")->get()->toArray();

   dd($res, count($res));
})->purpose('Display an inspiring quote');






