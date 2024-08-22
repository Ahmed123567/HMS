<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    public function recordsAjax(Patient $patient)
    {

        $records = $patient->records()->paginate(6)->withPath(request()->get("paginationPath"));

        return view("ajaxResponse.patientRecords", compact("records"));
    }
}
