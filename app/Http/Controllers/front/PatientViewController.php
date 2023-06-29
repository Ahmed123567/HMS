<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientProfileUpdateRequest;
use App\Http\Requests\PatientReserveAppointmentRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateAdminProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\AppointmentResrvation;
use App\Models\Department;
use Illuminate\Http\Request;

class PatientViewController extends Controller
{
    public function index() {
        return view("front.patient.index");
    }

    public function appointment() {

        $departments = Department::get();
        return view("front.patient.appointment", compact("departments"));
    }

    public function reserve(PatientReserveAppointmentRequest $request) {

        AppointmentResrvation::create(array_merge($request->validated(), ["patient_id" => auth()->user()?->patient->id]));
        return back()->with("success", "appoinment reserved successfully");
    }


    public function accountUpdate(UpdateProfileRequest $request) {
        auth()->user()->update($request->data());
        return back()->with("success", "profile updated successfully");
    }

}

