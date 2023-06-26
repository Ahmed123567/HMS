<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\ExecutableFinder;

class RunCovid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:covid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        
        $python = (new ExecutableFinder())->find('py');

        $result = Process::path(storage_path("app/ai_models/Covid/"))->run("$python run.py");
            
        Storage::put('ai_models/Covid/result.txt', $result->output());
    }
}
