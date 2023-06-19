<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::truncate();
        $permissions = $this->registerPermissions();

        $permissions->each(function ($name) {
            Permission::create(compact("name"));
        });


        $role = Role::firstOrCreate(["name" => "admin"]);

        $role->assignPermissions($permissions->toArray());
    }


    private function registerPermissions()
    {
        $permissions = collect([
            $this->allPermissions("users"),
            $this->allPermissions("employees"),
            $this->allPermissions("roles"),
        ]);
        return $permissions->flatten();
    }

    private function allPermissions($module)
    {
        return [
            "create $module",
            "update $module",
            "delete $module",
            "manage $module",
        ];
    }

    private function deletePermission($module)
    {
        return "delete $module";
    }

    private function updatePermission($module)
    {
        return "update $module";
    }
    private function createPermission($module)
    {
        return "create $module";
    }

    private function managePermission($module)
    {
        return "manage $module";
    }
}
