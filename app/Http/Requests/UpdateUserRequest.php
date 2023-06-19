<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required"],
            "password" => ["nullable",Password::min(6)],
            "email" => ["required", "email", "unique:users,email," . $this->user->id],
            "phone_number" => [new PhoneNumber],
            "image" => ['mimes:jpeg,jpg,png'],
            "role_id" => ["integer", "exists:roles,id"],
            "employee_id" => ["required"]
        ];
        
    }

    
    public function saveImage(string $path = "public/images") : string {
        if(!$this->image) {
            return auth()->user()->image ?? "default.jpg";
        }
        
        $image_path = $this->image->store($path);
        $image_path = explode("/", $image_path);
        return end($image_path);
    }
}
