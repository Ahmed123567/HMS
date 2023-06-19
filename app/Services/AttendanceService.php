<?php

namespace App\Services;

use App\Models\AttendanceEmployee;
use Carbon\Carbon;

/**
 * Summary of AttendanceService
 */
class AttendanceService
{

    /**
     * Summary of record
     * @var
     */
    private $record;
    /**
     * Summary of recordShift
     * @var
     */
    private $recordShift;


    public function __construct()
    {
    }

    /**
     * Summary of setRecord
     * @param AttendanceEmployee $record
     * @return AttendanceService
     */
    public function setRecord(AttendanceEmployee $record)
    {

        $this->record = $record;
        $this->recordShift = $record->shift;

        return $this;
    }

    /**
     * Summary of addClockInAndLate
     * @param Carbon $punchIn
     * @return AttendanceService
     */
    public function addClockInAndLate(Carbon $punchIn)
    {

        $this->clockIn($punchIn->format("H:i:s"))->calcLate()->overIn();
        return $this;
    }

    /**
     * Summary of addClockOut
     * @param Carbon $punchOut
     * @return AttendanceService
     */
    public function addClockOut(Carbon $punchOut)
    {
        $this->clockOut($punchOut->format("H:i:s"))->calcEarlyOut()->overOut();
        return $this;
    }

    /**
     * Summary of clockIn
     * @param mixed $clockInTime
     * @return AttendanceService
     */
    public function clockIn($clockInTime)
    {
        $this->record->update(["clock_in" => $clockInTime]);
        return $this;
    }

    /**
     * Summary of clockOut
     * @param mixed $clockOutTime
     * @return AttendanceService
     */
    public function clockOut($clockOutTime)
    {

        $this->record->update(["clock_out" => $clockOutTime]);
        return $this;
    }

    public function calcEarlyOut() {
        if (
            $this->recordShift &&
            $this->recordShift->to->gt($this->record->clockOutCarbon())
        ) {

            $earlyOut = $this->recordShift->to->diffInMinutes($this->record->clockOutCarbon());
            $this->record->update(["early_leaving" => $earlyOut]);
            return $this;
        }

        $this->record->update(["early_leaving" => 0]);
        return $this;
    }

    /**
     * Summary of calcLate
     * @param mixed $punchIn
     * @return AttendanceService
     */
    public function calcLate()
    {
        if (
            $this->recordShift &&
            $this->recordShift->from->lt($this->record->clockInCarbon())
        ) {

            $late = $this->recordShift->from->diffInMinutes($this->record->clockInCarbon());
            $this->record->update(["late" => $late]);
        }

        return $this;
    }

    public function overOut() {
        if (
            $this->recordShift &&
            $this->recordShift->to->lt($this->record->clockOutCarbon())
        ) {

            $overtime = $this->recordShift->to->diffInMinutes($this->record->clockOutCarbon());
            $this->record->update(["over_out" => $overtime]);

        }
        
        return $this;
    }

    /**
     * Summary of calcLate
     * @param mixed $punchIn
     * @return AttendanceService
     */
    public function overIn()
    {
        if (
            $this->recordShift &&
            $this->recordShift->from->gt($this->record->clockInCarbon())
        ) {

            $overtime = $this->recordShift->from->diffInMinutes($this->record->clockInCarbon());
            $this->record->update(["over_in" => $overtime]);
        }

        return $this;
    }


}
