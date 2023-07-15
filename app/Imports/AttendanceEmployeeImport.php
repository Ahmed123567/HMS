<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\AttendanceEmployee;
use App\Models\Employee;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttendanceEmployeeImport implements ToModel, WithStartRow, WithHeadingRow {
    
    public function __construct(private AttendanceService $attendanceService)
    {
        
    }

    public function model(array $row)
    {

        $punchTime = Carbon::instance(Date::excelToDateTimeObject($row['punch_time']));
        $employee = Employee::find($row['code']);

        if($employee) {
            $record = AttendanceEmployee::firstOrCreate(
                [
                    "employee_id"  => $row['code'],
                    "date" => $punchTime->format("Y-m-d")
                ]
                , [
                    "status" => "present",
                    "shift_id" => $employee->shift?->id,
                    'created_by' => 0
                ]
            );

        }

    

        if( !$record->isclockedIn() ) {
            $this->attendanceService->setRecord($record)->addClockInAndLate($punchTime);
        } else {
            $this->attendanceService->setRecord($record)->addClockOut($punchTime);
        }

    }

    

    public function startRow(): int
    {
        return 2;
    }




   

}