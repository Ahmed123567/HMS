<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index() {

        $permissions = Permission::get();
        return view("admin.permission.index", compact("permissions"));
    }

    public function store(StorePermissionRequest $request) {
        
        Permission::create($request->validated());
        return back()->with("success", "permission stored successfully");
    }

    public function destroy(Permission $permission) {
      
        $permission->delete();
        return back()->with("success", "permission deleted successfully");
    }
}
