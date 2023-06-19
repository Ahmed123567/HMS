<?php

namespace App\View\Components;

use App\Models\Permission;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PermissionComponenet extends Component
{
   
    public $permissions;

    public function __construct(public $values = null)
    {   
        $this->permissions = Permission::get();
    }

    public function render(): View|Closure|string
    {
        return view('components.permission-componenet');
    }
}
