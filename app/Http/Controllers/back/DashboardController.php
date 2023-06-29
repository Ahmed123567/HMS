<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $employee = auth()->user()?->employee;
        return view("admin.dashboard.index", compact("employee"));
    }
}
