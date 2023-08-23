<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'View Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'Edit Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'Create Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'Delete Users', 'guard_name' => 'web']);

        Permission::create(['name' => 'View Projects', 'guard_name' => 'web']);
        Permission::create(['name' => 'Edit Projects', 'guard_name' => 'web']);
        Permission::create(['name' => 'Create Projects', 'guard_name' => 'web']);
        Permission::create(['name' => 'Delete Projects', 'guard_name' => 'web']);

        Permission::create(['name' => 'View Categories', 'guard_name' => 'web']);
        Permission::create(['name' => 'Edit Categories', 'guard_name' => 'web']);
        Permission::create(['name' => 'Create Categories', 'guard_name' => 'web']);
        Permission::create(['name' => 'Delete Categories', 'guard_name' => 'web']);

        Permission::create(['name' => 'View Storages', 'guard_name' => 'web']);
        Permission::create(['name' => 'Edit Storages', 'guard_name' => 'web']);
        Permission::create(['name' => 'Create Storages', 'guard_name' => 'web']);
        Permission::create(['name' => 'Delete Storages', 'guard_name' => 'web']);

        Permission::create(['name' => 'View Settings', 'guard_name' => 'web']);
        Permission::create(['name' => 'Edit Settings', 'guard_name' => 'web']);
        Permission::create(['name' => 'Create Settings', 'guard_name' => 'web']);
        Permission::create(['name' => 'Delete Settings', 'guard_name' => 'web']);
    }
}
