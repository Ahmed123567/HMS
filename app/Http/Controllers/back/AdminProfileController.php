<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function index() {
        return view("admin.profile.index");
    }

    public function update(UpdateProfileRequest $request) {
        
        auth()->user()->update($request->data());
        return back()->with("success", "profile updated successfully");
    }

}
