<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\Patient;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployeeSelect extends Component
{

    public $employees;
    
    public function __construct(public string|null $value = null, $patients = false)
    {
        
        if($patients) {
            $this->employees = Patient::pluck("name", "id");
        }else {
            $this->employees = Employee::pluck("name", "id");
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employee-select');
    }
}
