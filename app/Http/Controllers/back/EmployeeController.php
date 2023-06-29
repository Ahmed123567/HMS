<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Shift;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with("user","shift", "department")
                            ->when(auth()->user()->isManager(), function($q) {
                                return $q->underDepartment(auth()->user()?->managedDepartment()?->id);
                            })
                            ->get();

        return view("admin.employee.index", compact("employees"));
    }

    public function create()
    {
        $departments = Department::pluck("name", "id");
        $shifts = Shift::pluck("name", "id"); 
        
        return view("admin.employee.create", compact("departments","shifts"));
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->validated());
        return back()->with("success", "employee created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        
        $departments = Department::pluck("name", "id");
        $shifts = Shift::pluck("name", "id"); 

        return view("admin.employee.edit", compact("departments","shifts", "employee"));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return back()->with("success", "employee updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with("success", "Employee deleted successfully");
    }

   
    
    public function getPeople(Role $role) {
        
        if($role->isPatient()) {
            return Patient::select("id", "name")->get();
        }

        return Employee::select("id", "name")->get();
    }

}
