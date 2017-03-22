<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->dropIfExists('expediente_user');
        Schema::connection('pgsql')->dropIfExists('expedientes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql')->create('expedientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero')->unsigned();
            $table->timestamps();
        });

        Schema::connection('pgsql')->create('expediente_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

            $table->integer('expediente_id')->unsigned();
            $table->foreign('expediente_id')
              ->references('id')
              ->on('expedientes')
              ->onDelete('restrict');

            $table->timestamps();
        });
    }
}
