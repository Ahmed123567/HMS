<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class AssignPermissionRequest extends FormRequest
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
            "role" => ["integer", "exists:roles,id"],
            "permissions" => ['required'],
            "permissions.*" => ["required", "integer", "exists:permissions,id"]
        ];
    }

    public function role() {
        return Role::find($this->role);
    }

    public function permissions() {
        return $this->permissions;
    }
}
