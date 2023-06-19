<?php

namespace App\Models\concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait useDefaultCasts {


    public function __construct() {
        $this->setDefaultCasts();
        parent::__construct();
    }

    public function setDefaultCasts()
    {
        
        $columns = DB::select('describe ' . $this->getTable());

        foreach ($columns as $column) {

            if (!array_key_exists($column->Field, $this->casts) && $castTo = $this->castTo($column->Type)) {
                $this->casts[$column->Field] = $castTo;
            }
        }
    }



    public function castTo($type)
    {
        if (Str::contains($type, ["int"])) {
            return "int";
        }

        if (Str::contains($type, ["float", "double"])) {
            return "float";
        }

        if (Str::contains($type, ["decimal"])) {
            return "decimal";
        }

        if (Str::contains($type, ["time", "date", "year"])) {
            return "datetime";
        }
    }


}