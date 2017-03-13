<?php

use App\Models\Admin\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PrepareForLaratrust extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // drop de antiguos roles y permisos
        Schema::connection('pgsql')->dropIfExists('role_user');
        Schema::connection('pgsql')->dropIfExists('permission_role');
        Schema::connection('pgsql')->dropIfExists('permission_user');
        Schema::connection('pgsql')->dropIfExists('permissions');
        Schema::connection('pgsql')->dropIfExists('roles');

        // ajusto la tabla de usuarios
        Schema::connection('pgsql')->table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('superadmin');

            // momentaneamente nullable
            $table->string('name')->nullable();
        });

        // migramos los datos de los campos firstname y lastname a name
        foreach(User::all() as $user) {
            $user->name = "{$user->firstname} {$user->lastname}";
            $user->save();
        }

        // termino de ajustar la tabla de usuarios
        Schema::connection('pgsql')->table('users', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');

            // ya no es mas nullable
            $table->string('name')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql')->create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::connection('pgsql')->create('role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->primary(['role_id', 'user_id']);
        });

        Schema::connection('pgsql')->create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::connection('pgsql')->create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')
                  ->references('id')
                  ->on('permissions')
                  ->onDelete('cascade');

            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::connection('pgsql')->create('permission_user', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('permission_id')
                  ->references('id')
                  ->on('permissions')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->primary(['permission_id', 'user_id']);
        });

        Schema::connection('pgsql')->table('users', function (Blueprint $table) {
            $table->string('username')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->boolean('superadmin')->default(0);
        });

        // migramos los datos name a firtsname
        foreach(User::all() as $user) {
            $user->firstname = $user->name;
            $user->save();
        }

        Schema::connection('pgsql')->table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
