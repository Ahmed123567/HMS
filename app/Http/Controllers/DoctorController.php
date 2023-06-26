<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function patients(Employee $doctor) {
       
        $patients = $doctor->patients();

        return view("admin.doctor.patients", compact("patients"));
    }
}
