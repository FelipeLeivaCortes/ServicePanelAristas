<?php

namespace Database\Seeders;

use App\Models\CustomPermission;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (CustomPermission::CRUD_COMPANIES as $permission) {
            Permission::create([
                'name'      => $permission,
                'family'    => CustomPermission::FAMILIES['companies']['name'],
                'order'     => CustomPermission::FAMILIES['companies']['order']
            ]);
        }

        foreach (CustomPermission::CRUD_PERMISSIONS as $permission) {
            Permission::create([
                'name'      => $permission,
                'family'    => CustomPermission::FAMILIES['permissions']['name'],
                'order'     => CustomPermission::FAMILIES['permissions']['order']
            ]);
        }

        foreach (CustomPermission::CRUD_ROLES as $permission) {
            Permission::create([
                'name'      => $permission,
                'family'    => CustomPermission::FAMILIES['roles']['name'],
                'order'     => CustomPermission::FAMILIES['roles']['order']
            ]);
        }

        foreach (CustomPermission::CRUD_USERS as $permission) {
            Permission::create([
                'name'      => $permission,
                'family'    => CustomPermission::FAMILIES['users']['name'],
                'order'     => CustomPermission::FAMILIES['users']['order']
            ]);
        }

        foreach (CustomPermission::CRUD_SYNC as $permission) {
            Permission::create([
                'name'      => $permission,
                'family'    => CustomPermission::FAMILIES['sync']['name'],
                'order'     => CustomPermission::FAMILIES['sync']['order']
            ]);
        }
    }
}
