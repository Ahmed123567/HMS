<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Crud extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Model $model, public $editUrl = null, public $deleteUrl = null, public $hasDelete = true)
    {
        $this->setUrls();
    }

    private function setUrls() {
        $classname = lcfirst(class_basename($this->model));
       
        if($this->editUrl == null) {
            $this->editUrl = $classname . ".edit";
        }

        if($this->deleteUrl == null) {
            $this->deleteUrl = $classname . ".destroy";
        }
        
    }

    /**
     * 
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.crud');
    }
}
