<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shifts = Shift::get();
        return view("admin.shift.index", compact("shifts"));
    }

    public function create()
    {       
        return view("admin.shift.create");
    }

    public function store(StoreShiftRequest $request)
    {

        Shift::create($request->validated());
        return back()->with("success", "shift created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        return view("admin.shift.edit", compact("shift"));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShiftRequest $request, Shift $shift)
    {
        $shift->update($request->validated());

        return back()->with("success", "shift updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return back()->with("success", "Shift deleted successfully");
    }

}
