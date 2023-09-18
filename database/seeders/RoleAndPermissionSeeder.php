<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Enums\Permission;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as RoleModel;
use Spatie\Permission\Models\Permission as PermissionModel;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            Role::ADMIN->value,
            Role::TEACHER->value,
            Role::STUDENT->value,
        ];

        $permissions = [
            Permission::VIEW_ANY_RESOURCE->value,
            Permission::VIEW_RESOURCE->value,
            Permission::CREATE_RESOURCE->value,
            Permission::UPDATE_RESOURCE->value,
            Permission::DELETE_RESOURCE->value,
            Permission::GET_FILE_RESOURCE->value,
            Permission::DOWNLOAD_FILE_RESOURCE->value,
            Permission::SHOW_FILE_RESOURCE->value,
        ];

        $permissionsProtected = [
            Permission::VIEW_PROTECTED_RESOURCE->value,
            Permission::UPDATE_PROTECTED_RESOURCE->value,
            Permission::DELETE_PROTECTED_RESOURCE->value,
            Permission::GET_PROTECTED_FILE_RESOURCE->value,
            Permission::DOWNLOAD_PROTECTED_FILE_RESOURCE->value,
            Permission::SHOW_PROTECTED_FILE_RESOURCE->value,
        ];

        $permissionsFull = Arr::collapse([$permissions, $permissionsProtected]);

        foreach ($roles as $role) {
            RoleModel::create(['name' => $role]);
        }

        foreach ($permissionsFull as $permission) {
            PermissionModel::create(['name' => $permission]);
        }

        $roleAdmin = RoleModel::firstWhere('name', Role::ADMIN->value);
        $roleTeacher = RoleModel::firstWhere('name', Role::TEACHER->value);
        $roleStudent = RoleModel::firstWhere('name', Role::STUDENT->value);

        $roleAdmin->syncPermissions($permissionsFull);
        $roleTeacher->syncPermissions($permissions);
        $roleStudent->syncPermissions([Permission::GET_FILE_RESOURCE->value, Permission::SHOW_FILE_RESOURCE->value]);
    }
}
