<?php

namespace App\Pipline;

// use Illuminate\Database\Eloquent\Builder;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class FilterPipline {

    protected $queryParam;

    public function __invoke(Builder $model, $next)
    {
        if(! request()->has($this->getQueryParam()) || request()->query($this->getQueryParam()) == null) {
            return $next($model);
        }

        return $next($this->filter($model, request()->query($this->getQueryParam())));
    }

    public function getQueryParam() {
        return $this->queryParam ?? $this->defaultQuery() ;
    }

    public function defaultQuery() {
        $className = explode("\\", get_class($this));
        $className = end($className);
        return Str::snake(Str::before($className, "Filter"));
    }

    abstract public function filter($model, $param);
}
