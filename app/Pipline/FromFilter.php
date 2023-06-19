<?php

namespace App\Pipline;



class FromFilter extends FilterPipline {
    
    public function filter($model, $param) {
        $model->overlap($param, now()->addCenturies(1));
    }
}