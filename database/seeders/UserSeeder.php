<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_permissions')->truncate();
        User::truncate();
        Role::truncate();
        Permission::truncate();

        $role = Role::create([
                    "name" => "admin"
                ]);

        $permission = Permission::create([
            "name" => "create user"
        ]);

        $role->permissions()->attach($permission->id);

        User::create([
            "name" => "ahmed",
            "email" => "ahmed@email.com",
            "password" => 123456,
            "role_id"  => $role->id
        ]);
    }
}
