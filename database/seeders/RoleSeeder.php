<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'User', 'guard_name' => 'web']);

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            if ($permission->name == 'View Products')
                $userRole->givePermissionTo($permission);
            if (!str_contains($permission->name, 'Delete') && $permission->name != 'Edit Settings' && $permission->name != 'Create Settings')
                $adminRole->givePermissionTo($permission);
            $superAdminRole->givePermissionTo($permission);
        }
    }
}
