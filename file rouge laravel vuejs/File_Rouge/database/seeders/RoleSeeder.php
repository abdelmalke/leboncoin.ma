<?php

// namespace Database\Seeders;

// use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

// class RoleSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         // Check and create roles if they don't exist
//         if (!Role::where('name', 'admin')->exists()) {
//             $adminRole = Role::create(['name' => 'admin']);
//         } else {
//             $adminRole = Role::where('name', 'admin')->first();
//         }

//         if (!Role::where('name', 'user')->exists()) {
//             $userRole = Role::create(['name' => 'user']);
//         } else {
//             $userRole = Role::where('name', 'user')->first();
//         }

//         if (!Role::where('name', 'editor')->exists()) {
//             $editorRole = Role::create(['name' => 'editor']);
//         } else {
//             $editorRole = Role::where('name', 'editor')->first();
//         }

//         // Check and create permissions if they don't exist
//         if (!Permission::where('name', 'create post')->exists()) {
//             Permission::create(['name' => 'create post']);
//         }

//         if (!Permission::where('name', 'edit post')->exists()) {
//             Permission::create(['name' => 'edit post']);
//         }

//         if (!Permission::where('name', 'delete post')->exists()) {
//             Permission::create(['name' => 'delete post']);
//         }

//         // Assign permissions to roles
//         $adminRole->givePermissionTo(['create post', 'edit post', 'delete post']);
//         $editorRole->givePermissionTo(['create post', 'edit post', 'delete post']);
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check and create roles if they don't exist
        if (!Role::where('name', 'admin')->exists()) {
            $adminRole = Role::create(['name' => 'admin']);
        } else {
            $adminRole = Role::where('name', 'admin')->first();
        }

        if (!Role::where('name', 'user')->exists()) {
            $userRole = Role::create(['name' => 'user']);
        } else {
            $userRole = Role::where('name', 'user')->first();
        }

        if (!Role::where('name', 'editor')->exists()) {
            $editorRole = Role::create(['name' => 'editor']);
        } else {
            $editorRole = Role::where('name', 'editor')->first();
        }

        // Check and create post-related permissions if they don't exist
        if (!Permission::where('name', 'create post')->exists()) {
            Permission::create(['name' => 'create post']);
        }

        if (!Permission::where('name', 'edit post')->exists()) {
            Permission::create(['name' => 'edit post']);
        }

        if (!Permission::where('name', 'delete post')->exists()) {
            Permission::create(['name' => 'delete post']);
        }

        // Check and create user management permissions if they don't exist
        if (!Permission::where('name', 'create user')->exists()) {
            Permission::create(['name' => 'create user']);
        }

        if (!Permission::where('name', 'edit user')->exists()) {
            Permission::create(['name' => 'edit user']);
        }

        if (!Permission::where('name', 'delete user')->exists()) {
            Permission::create(['name' => 'delete user']);
        }

        if (!Permission::where('name', 'view user')->exists()) {
            Permission::create(['name' => 'view user']);
        }

        // Assign post-related permissions to roles
        $adminRole->givePermissionTo(['create post', 'edit post', 'delete post']);
        $editorRole->givePermissionTo(['create post', 'edit post', 'delete post']);

        // Assign user management permissions to the admin role
        $adminRole->givePermissionTo(['create user', 'edit user', 'delete user', 'view user']);
    }
}
