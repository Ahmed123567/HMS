<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Patient;
use App\Models\Room;
use App\Models\RoomResrvation;
use Illuminate\Http\Request;

class ResrvationController extends Controller
{
    
    public function index() {
    
        $rooms = Room::get();
        $patients = Patient::get();
        return view("admin.resrvation.index", compact("rooms", "patients"));
    }


    public function store(StoreReservationRequest $requset) {
       
        if(!$requset->reservationIsValid()) {
            return back()->with("error", "room has no avilable beds");
        }
        
        RoomResrvation::create($requset->validated());
        return back()->with("success", "room reservation stored successfully");
    }

    public function confirm(RoomResrvation $roomResrvation) {
        
        $roomResrvation->confirm();
        return back()->with("success", "room resrvation confirmed successfully");
    }

}
