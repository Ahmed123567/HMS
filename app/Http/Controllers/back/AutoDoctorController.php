<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\CovidCheckRequest;

class AutoDoctorController extends Controller
{
    public function index() {
        return view("admin.autoDoctor.index");
    }

    public function covid() {
        return view("admin.autoDoctor.covid");
    }

    public function covidCheck(CovidCheckRequest $req) {
                    
        $result = Http::flask()
                        ->attach('file', file_get_contents($req->image), 'sample.' . $req->image->extension())
                        ->post("covid");
        
        return <<<html
            <p class="text-success text-center covid_result" > the result is ` {$result->json()['result']} `</p>
        html;
    }


    public function brainTumor() {
        return view("admin.autoDoctor.brainTumor");
    }

    public function brainTumorCheck(CovidCheckRequest $req) {
                    
        $result = Http::flask()
                        ->attach('file', file_get_contents($req->image), 'sample.' . $req->image->extension())
                        ->post("brainTumor");
        
        return <<<html
            <p class="text-success text-center covid_result" > the result is ` {$result->json()['result']} `</p>
        html;
    }

    public function ecg() {
        return view("admin.autoDoctor.ecg");
    }

    public function ecgCheck(CovidCheckRequest $req) {

        $result = Http::flask()
                        ->attach('file', file_get_contents($req->image), 'sample.csv')
                        ->post("ecg");
        
        return <<<html
            <p class="text-success text-center covid_result" > the result is ` {$result->json()['result']} `</p>
        html;
    }
}
