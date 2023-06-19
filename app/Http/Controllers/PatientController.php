<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
   
    public function index()
    {
        $patients = Patient::with("user")->get();

        return view("admin.patient.index", compact("patients"));
    }

    public function create()
    {
        return view("admin.patient.create");
    }

    public function store(StorePatientRequest $request)
    {
        Patient::create($request->validated());
        return back()->with("success", "patient created successfully");
    }


    public function edit(Patient $patient)
    {   
        return view("admin.patient.edit", compact("patient"));   
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());
        return back()->with("success", "patient updated successfully");
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->with("success", "Patient deleted successfully");
    }
   


}
