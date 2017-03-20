<?php

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorizationUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        $user           = new User();
        $user->name     = 'admin';
        $user->email    = 'admin@app.com';
        $user->password = bcrypt('123456');
        $user->save();

        $role       = Role::where('name', 'admin')->first();
        $permission = Permission::where('name', 'admin-permissions-browse')->first();

        $user->attachRole($role);
        $user->attachPermission($permission);
        $user->save();
    }
}
