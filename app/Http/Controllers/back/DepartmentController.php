<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $departments = Department::withCount("employees")->with("manager")->get();
        return view("admin.department.index", compact("departments"));
    }

    public function create()
    {

        $managers = Employee::managers()->pluck("name", "id");
        return view("admin.department.create", compact("managers"));
    }

    public function store(StoreDepartmentRequest $request)
    {

        Department::create($request->validated());
        return back()->with("success", "department created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {

        $managers = Employee::managers()->pluck("name", "id");
        return view("admin.department.edit", compact("department","managers"));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {

        $department->update($request->validated());
        return back()->with("success", "department updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with("success", "Department deleted successfully");
    }

    public function deprtmentDoctors(Department $department) {

        $doctors = $department->employees()->doctors()->get();
        return view("admin.department.doctors", compact("doctors"));
    }

}
