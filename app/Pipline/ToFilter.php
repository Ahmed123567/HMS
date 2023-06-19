<?php

namespace App\Pipline;


class ToFilter extends FilterPipline {
    
    
    public function filter($model, $param) {
        return $model->overlap(now()->addCenturies(1), $param);
    }
}