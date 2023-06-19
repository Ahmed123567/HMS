<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SelectComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public array|Collection $models, public string $name,  public mixed $value = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-component');
    }
}
