<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles = Role::with("permissions:name")->get();
        return view("admin.role.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view("admin.role.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        DB::transaction(function () use ($request) {
            $role = Role::create($request->only("name"));
            $role->assignPermissionIds($request->get("permissions") ?? []);
        });
        
        return back()->with("success", "role created successfully");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {   
        $role->load("permissions");
        return view("admin.role.edit", compact("role"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        DB::transaction(function () use ($request, $role) {
            $role->update($request->only("name"));
            $role->assignPermissionIds($request->get("permissions") ?? []);
        });

        return back()->with("success", "role updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with("success", "role deleted successfully");
    }
}
