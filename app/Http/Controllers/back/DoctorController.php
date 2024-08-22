<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function patients(Employee $doctor) {
       
        $patients = $doctor->patients();
        return view("admin.doctor.patients", compact("patients"));
    }

    public function resrvationAjax(Employee $doctor) {

        $reservations = $doctor->reservatoins()->paginate(6)->withPath(request()->get("paginationPath"));
        return view("ajaxResponse.doctorResrevations", compact("reservations"));
    }
}
