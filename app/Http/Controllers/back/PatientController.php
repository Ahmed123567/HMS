<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientMedicalHistoryRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\PatientRecord;
use STS\ZipStream\ZipStreamFacade;
use Illuminate\Support\Str;

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


    public function medicalProfile(Patient $patient)
    {
        return view("admin.patient.medical_profile", compact("patient"));
    }

    
    public function medicalHistory(Patient $patient) {

        return view("admin.patient.medical_history", compact("patient"));
    }

    public function updateHistory(UpdatePatientMedicalHistoryRequest $request, Patient $patient) {
        
        $patient->update($request->validated());
        return back()->with("success", "medical history updated successfully");
    }

    public function files(PatientRecord $record)
    {

        return ZipStreamFacade::create(
            'mytest12.zip',
            $record->files->map(fn ($file) => storage_path("app\\" . $file))->flip()->toArray()
        );
    }


 
}
