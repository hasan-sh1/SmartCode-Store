<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // أدوار أساسية
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole  = Role::firstOrCreate(['name' => 'user',  'guard_name' => 'web']);

        // أذونات أساسية
        $permissions = [
            'manage products', 'view products',
            'manage orders',   'view orders',
            'manage services', 'view services',
            'manage categories','view categories',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // منح الأذونات للأدوار
        $adminRole->givePermissionTo($permissions);
        $userRole->givePermissionTo(['view products','view orders','view services','view categories']);
    }
}