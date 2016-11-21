<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewSchemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::getConnection()->statement('CREATE SCHEMA turnos');
        Schema::getConnection()->statement('CREATE SCHEMA solicitudes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::getConnection()->statement('DROP SCHEMA IF EXISTS turnos CASCADE');
        Schema::getConnection()->statement('DROP SCHEMA IF EXISTS solicitudes CASCADE');
    }
}
