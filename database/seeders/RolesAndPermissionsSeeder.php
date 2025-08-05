<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Lesson Plan
        Permission::create(['name' => 'show lesson-plans']);
        Permission::create(['name' => 'create lesson-plans']);
        Permission::create(['name' => 'edit lesson-plans']);
        Permission::create(['name' => 'delete lesson-plans']);

        // Lesson Plan
        Permission::create(['name' => 'show lesson-materials']);
        Permission::create(['name' => 'create lesson-materials']);
        Permission::create(['name' => 'edit lesson-materials']);
        Permission::create(['name' => 'delete lesson-materials']);

        // Student Workshop
        Permission::create(['name' => 'show student-workshops']);
        Permission::create(['name' => 'create student-workshops']);
        Permission::create(['name' => 'edit student-workshops']);
        Permission::create(['name' => 'delete student-workshops']);

        // Evaluation
        Permission::create(['name' => 'show evaluations']);
        Permission::create(['name' => 'create evaluations']);
        Permission::create(['name' => 'edit evaluations']);
        Permission::create(['name' => 'delete evaluations']);

        // Users List
        Permission::create(['name' => 'show users-list']);

        // User
        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);

        Role::create([
            'name' => 'administrator'
        ]);

        Role::create([
            'name' => 'teacher'
        ]);

        // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
