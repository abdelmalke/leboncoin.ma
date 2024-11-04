<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Check if the 'create user' permission already exists
        if (!Permission::where('name', 'create user')->exists()) {
            Permission::create(['name' => 'create user']);
        }

        // Check if the 'edit user' permission already exists
        if (!Permission::where('name', 'edit user')->exists()) {
            Permission::create(['name' => 'edit user']);
        }

        // Check if the 'delete user' permission already exists
        if (!Permission::where('name', 'delete user')->exists()) {
            Permission::create(['name' => 'delete user']);
        }
    }
}
