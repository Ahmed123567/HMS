<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\CloseAppointmentResrvationRequest;
use App\Http\Requests\StoreAppointmentResrvationRequest;
use App\Models\AppointmentResrvation;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {

        $patients = Patient::get();
        $departments = Department::get();

        return view("admin.appoinmentReservation.index", compact("departments", "patients"));
    }

    public function store(StoreAppointmentResrvationRequest $request)
    {

        AppointmentResrvation::create($request->validated());
        return back()->with("success", "appoinment reserved successfully");
    }


    public function doctorAjax(Employee $doctor)
    {

        $doctor->load(["reservatoins" => function ($q) {
            return $q->AtDay(request("time", now()))->orderBy("time");
        }, "reservatoins.patient", "shift"]);

        
        return view("admin.appoinmentReservation.doctorsResrvations", compact("doctor"));
    }


    public function doctorPatientViewAjax(Employee $doctor)
    {

        $doctor->load(["reservatoins" => function ($q) {
            return $q->AtDay(request("time", now()))->orderBy("time");
        }, "reservatoins.patient", "shift"]);
        
        return view("admin.appoinmentReservation.doctorReservationsPatienView", compact("doctor"));
    }


    public function confirm(AppointmentResrvation $appointmentResrvation)
    {

        $appointmentResrvation->confirm();
        return back()->with("success", "appointment confimed successfully");
    }

    public function resrvations(Employee $doctor)
    {

        $reservations = $doctor?->reservatoins()->latest()->when(request("today") == 1, function ($q) {
            return $q->today();
        })->get();

        return view("admin.doctor.resrvations", compact("reservations"));
    }

    public function report(AppointmentResrvation $appointmentResrvation)
    {

        return view("admin.doctor.appointmentReport", compact("appointmentResrvation"));
    }

    public function close(CloseAppointmentResrvationRequest $request, AppointmentResrvation $appointmentResrvation)
    {

        DB::transaction(function () use ($request, $appointmentResrvation) {
            $appointmentResrvation->report()->create($request->data());
            $appointmentResrvation->close();
        });

        return back()->with("success", "appointment closed successfully");
    }
}
