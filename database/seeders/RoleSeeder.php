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
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'User']);
        $role3 = Role::create(['name' => 'Inventory Manager']);

        Permission::create(['name' => 'Ver Dashboard'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'Ver Inventario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'Crear Inventario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'Editar Inventario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'Anular Inventario'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'Editar'])->assignRole([$role1]);
        Permission::create(['name' => 'Anular Documento'])->assignRole([$role1]);
        Permission::create(['name' => 'user-create'])->assignRole([$role1]);
        Permission::create(['name' => 'user-edit'])->assignRole([$role1]);
        Permission::create(['name' => 'user-delete'])->assignRole([$role1]);
    }
}
