<?php

namespace App\View\Components;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use PHPUnit\Framework\Constraint\IsFalse;

class RoleSelect extends Component
{
    public $roles;

    public function __construct(public string|null $value = null, $withoutPatient = false)
    {
        $this->roles = Role::when($withoutPatient, function ($q) {
            return $q->where("name", "<>", Role::PATIENT);
        })
        ->pluck("name", "id");   
    }

    public function render(): View|Closure|string
    {
        return view('components.role-select');
    }
}
