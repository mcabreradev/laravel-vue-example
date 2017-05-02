<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TurnosUsuariosDropUniqueEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->table('usuarios', function (Blueprint $table) {
            $table->dropUnique('usuarios_email_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('usuarios', function (Blueprint $table) {
            $table->string('email')->unique()->change();
        });
    }
}
