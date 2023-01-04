<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::findOrCreate('admin');
        $PermissionCategory = Permission::findOrCreate('form category','web');
        $PermissionProduct = Permission::findOrCreate('form product','web');
        $role->givePermissionTo($PermissionCategory,$PermissionProduct);
    }
}
