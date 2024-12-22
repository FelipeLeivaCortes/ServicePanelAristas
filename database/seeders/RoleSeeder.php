<?php

namespace Database\Seeders;

use App\Models\CustomPermission;
use App\Models\CustomRole;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin     = Role::create(['name' => CustomRole::SUPERADMIN]);
        $admin          = Role::create(['name' => CustomRole::ADMIN]);

        $superAdmin->syncPermissions(
            array_merge(
                CustomPermission::CRUD_COMPANIES,
                CustomPermission::CRUD_ROLES,
                CustomPermission::CRUD_USERS,
                CustomPermission::CRUD_PERMISSIONS,
                CustomPermission::CRUD_SYNC
            ));
        
        $admin->syncPermissions(
            array_merge(
                CustomPermission::CRUD_USERS,
                CustomPermission::CRUD_SYNC
            ));
    }
}
