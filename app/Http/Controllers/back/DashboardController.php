<?php

namespace App\Http\Controllers\back;

use Abdo\Searchable\Attributes\Search;
use App\Http\Controllers\Controller;
use App\Models\AppointmentResrvation;
use App\Models\Patient;
use App\Services\LoginService;

class DashboardController extends Controller
{

    public function __invoke(Patient $patient, LoginService $loginService)
    {       
        $employee = auth()->user()?->employee;
        $res = AppointmentResrvation::filter()->pluck("time")->map(fn($time) => $time->format("Y-m-d"))->toArray();
        dump($res);
        return view("admin.dashboard.index", compact("employee"));
    }
}
