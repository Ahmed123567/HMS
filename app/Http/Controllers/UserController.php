<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $users = User::with("employee","role", "patient")->get();    
        return view("admin.user.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.user.create");
    }

    public function store(StoreUserRequest $request)
    {        
        User::create($this->getUserWithImage($request));
        
        return back()->with("success", "user created successfully");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view("admin.user.edit", ["user" => $user]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $userData = $this->getUserWithImage($request);

        $userData = $this->removePasswordIfNull($userData);

        $user->update($userData);

        return back()->with("success", "user updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with("success", "user deleted successfully");
    }



    private function getUserWithImage(StoreUserRequest|UpdateUserRequest $request) {
        $validated = $request->validated();
        $validated["image"] = $request->saveImage();
        return $validated;
    }

    private function removePasswordIfNull($userData) {
        if(is_null($userData["password"])) {
            unset($userData["password"]);   
        }

        return $userData;
    }

    
}
