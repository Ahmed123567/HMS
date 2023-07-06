<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Role extends Model
{
    use HasFactory;

    public const MANAGER = "manager";
    public const ADMIN = "admin";
    public const DOCTOR = "doctor";
    public const PATIENT = "patient";
    public const LAB_ANALYST = "LabAnalyst";

    protected $fillable = [
        "name"
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, "role_permissions", "role_id", "permission_id");
    }

    public function assignPermissions(Collection|array $permissions) : void
    {
        $permission_ids = Permission::whereIn("name", $permissions)->get()->pluck("id");
        $this->assignPermissionIds($permission_ids);
    }

    public function assignPermissionIds(Collection|array $permission_ids) : void
    {
        $this->permissions()->sync($permission_ids);
    }

    public function isDeletable() {
        return $this->is_deletable == 1;
    }

    public function isPatient() {
        return $this->name == static::PATIENT;
    }
}
