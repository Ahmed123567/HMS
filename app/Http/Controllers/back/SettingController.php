<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReservationSettingRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index() {
        return view("admin.setting.index");
    }

    public function reservation(UpdateReservationSettingRequest $request) {

        setSettings($request->validated());
        return back()->with("success", "reservation settings updated successfully");
    }
}
