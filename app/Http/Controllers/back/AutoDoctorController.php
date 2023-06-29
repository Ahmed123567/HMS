<?php

namespace App\Http\Controllers\back;

use Illuminate\Http\Request;
use App\Events\CovidCheckRan;
use App\Http\Controllers\Controller;

use function Pest\Laravel\json;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CovidCheckRequest;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Process\Process as ProcessProcess;
use Illuminate\Process\Exceptions\ProcessFailedException;

use Symfony\Component\Process\Exception\ProcessFailedException as ExceptionProcessFailedException;

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
}
