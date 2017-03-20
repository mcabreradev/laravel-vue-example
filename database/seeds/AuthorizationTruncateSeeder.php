<?php

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorizationTruncateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        DB::connection('pgsql')->statement("TRUNCATE TABLE users CASCADE");
        DB::connection('pgsql')->statement("TRUNCATE TABLE roles CASCADE");
        DB::connection('pgsql')->statement("TRUNCATE TABLE permissions CASCADE");
    }
}
