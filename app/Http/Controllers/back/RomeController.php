<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Patient;
use App\Models\Room;
use App\Pipline\FromFilter;
use App\Pipline\ToFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class RomeController extends Controller
{
    public function index()
    {
        $rooms = Room::get();
        return view("admin.room.index", compact("rooms"));
    }

    public function create()
    {       
        return view("admin.room.create");
    }

    public function store(StoreRoomRequest $request)
    {

        Room::create($request->validated());
        return back()->with("success", "room created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view("admin.room.edit", compact("room"));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        
        $room->update($request->validated());
        return back()->with("success", "room updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with("success", "Room deleted successfully");
    }


    public function roomAjax(Room $room) {
    
        $room->load(["reservatoins" => function(Builder $q) {
            return $q->overlap(request("from", now()), request("to", now()))->notExpired()->orderBy("from");
        } , "reservatoins.patient"]);

        return view("admin.room.roomsAjaxHtml", compact("room"));
    }


    public function showResrvations(Room $room) {

        $resrvaions = $room->reservatoins()->with("patient")->orderBy("from")->get();
        return view("admin.room.resrvations", compact("resrvaions", "room"));
    }

}