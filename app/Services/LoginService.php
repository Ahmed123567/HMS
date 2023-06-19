<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService {


    public function Login($email, $password) : string {

        $user = User::with("role", "role.permissions")->where("email", $email)->first();

        if(!$user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages(["email" => "invalid credentials"]);
        }
    
        $abilities = $user->role?->permissions->pluck("name")->toArray() ?? [];
        
        return $user->createToken("login_token", $abilities)->plainTextToken;
    }
}