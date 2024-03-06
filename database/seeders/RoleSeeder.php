<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $customer = Role::create(['name' => 'Customer']);

        $admin->givePermissionTo([
            'edit-order',
            'create-product',
            'edit-product',
            'delete-product'
        ]);

        $customer->givePermissionTo([
            'create-order'
        ]);
    }
}
