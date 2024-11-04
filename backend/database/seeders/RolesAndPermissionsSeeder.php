<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        //product permission
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'add product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'update product stock']);
        Permission::create(['name' => 'manage product variants']);
        Permission::create(['name' => 'view product reviews']);
        Permission::create(['name' => 'approve product review']);
        //order permission
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create order']);
        Permission::create(['name' => 'update order']);
        Permission::create(['name' => 'update order status']);
        Permission::create(['name' => 'cancel order']);
        Permission::create(['name' => 'issue refund']);
        Permission::create(['name' => 'cancel own order']);
        Permission::create(['name' => 'place order']);
        //cart permission
        Permission::create(['name' => 'add item']);
        Permission::create(['name' => 'update cart stock']);
        Permission::create(['name' => 'view cart']);
        Permission::create(['name' => 'remove item']);
        //user permission
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'write product review']);
        Permission::create(['name' => 'view own orders']);
        //add permission to role
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['view products','view product reviews','cancel own order','place order',
            'write product review','view own orders','edit user', 'add item','update cart stock','view cart','remove item']);
        $admin_account = (new \App\Models\User)->find(2);
        $admin_account->assignRole('admin');
        $user_defaul = User::find(1);
        $user_defaul->assignRole('user');
    }
}
