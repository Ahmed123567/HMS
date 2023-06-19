<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $employee = auth()->user()?->employee;
        return view("admin.dashboard.index", compact("employee"));
    }
}
