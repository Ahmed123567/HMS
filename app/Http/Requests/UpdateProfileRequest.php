<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class UpdateProfileRequest extends FormRequest
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
            "email" => ["required", "email", "unique:users,email," . auth()->user()->id],
            "phone_number" => [new PhoneNumber],
            "image" => ['mimes:jpeg,jpg,png'],
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

    public function data() {

        $data = $this->validated();
        $data["image"]  = $this->saveImage();
        return $data;
    }
}
