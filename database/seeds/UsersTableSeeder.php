<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'   => 'admin',
            'firstname'  => 'Admin',
            'lastname'   => 'Panal',
            'email'      => 'admin@change.me',
            'password'   => bcrypt('123456'),
            'superadmin' => true
        ]);
    }
}
