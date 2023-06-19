<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceEmployeeRequest;
use App\Imports\AttendanceEmployeeImport;
use App\Models\AttendanceEmployee;
use App\Services\AttendanceService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceEmployeeController extends Controller
{
    public function index()
    {
        $transactions = AttendanceEmployee::with("employee")
                                            ->orderBy("date")
                                            ->when(auth()->user()->isManager(), function ($q) {
                                                return $q->whereHas("employee", function($q) {
                                                    return $q->UnderDepartment(auth()->user()->managedDepartment()->id);
                                                });
                                            })
                                            ->get();
        return view("admin.attendanceEmployee.index", compact("transactions"));
    }

    public function create()
    {  
        return view("admin.attendanceEmployee.create");
    }

    public function store(StoreAttendanceEmployeeRequest $request, AttendanceService $attendanceService)
    {

        Excel::import(new AttendanceEmployeeImport($attendanceService), $request->file("file"));
        return back()->with("success", "transactions inserted successfully");
    }

}
