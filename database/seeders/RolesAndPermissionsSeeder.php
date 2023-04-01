<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tags Permissions
        Permission::create(['name' => 'view tags']);
        Permission::create(['name' => 'create tags']);
        Permission::create(['name' => 'edit tags']);
        Permission::create(['name' => 'delete tags']);

        // Questions Permissions
        Permission::create(['name' => 'view questions']);
        Permission::create(['name' => 'create questions']);
        Permission::create(['name' => 'edit questions']);
        Permission::create(['name' => 'delete questions']);

        // Answers Permissions
        Permission::create(['name' => 'view answers']);
        Permission::create(['name' => 'create answers']);
        Permission::create(['name' => 'edit answers']);
        Permission::create(['name' => 'delete answers']);

        // Votes Permissions
        Permission::create(['name' => 'view votes']);
        Permission::create(['name' => 'up votes']);
        Permission::create(['name' => 'down votes']);
        Permission::create(['name' => 'delete votes']);

        // Flags Permissions
        Permission::create(['name' => 'view flags']);
        Permission::create(['name' => 'create flags']);
        Permission::create(['name' => 'edit flags']);
        Permission::create(['name' => 'delete flags']);
        Permission::create(['name' => 'approve flags']);
        Permission::create(['name' => 'reject flags']);

        // Users Permissions
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        // Role Permissions
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'grant and revoke permission']);
        Permission::create(['name' => 'assign role']);

        // Permission Permissions
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'edit permissions']);
        Permission::create(['name' => 'delete permissions']);


        // Create Roles
        $superAdminRole = Role::create(['name' => 'super admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign Permissions to Roles
        $superAdminRole->syncPermissions(Permission::all());
        $adminRole->syncPermissions([
            'view tags',
            'create tags',
            'edit tags',
            'delete tags',
            'view questions',
            'create questions',
            'edit questions',
            'delete questions',
            'view answers',
            'create answers',
            'edit answers',
            'delete answers',
            'view votes',
            'up votes',
            'down votes',
            'delete votes',
            'view flags',
            'create flags',
            'edit flags',
            'delete flags',
            'approve flags',
            'reject flags'
        ]);
        $userRole->syncPermissions([
            'view tags',
            'view questions',
            'create questions',
            'edit questions',
            'delete questions',
            'view answers',
            'create answers',
            'edit answers',
            'delete answers',
            'view votes',
            'up votes',
            'down votes',
            'delete votes',
            'create flags',
            'edit flags',
            'delete flags'
        ]);
    }
}