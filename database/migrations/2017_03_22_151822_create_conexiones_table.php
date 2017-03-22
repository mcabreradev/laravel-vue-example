<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConexionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->create('conexiones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expediente')->unsigned();
            $table->integer('unidad')->unsigned()->nullable();
            $table->string('domicilio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql')->dropIfExists('conexiones');
    }
}
