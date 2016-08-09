<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelAguaRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_agua_registros', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('registrado_el')->unique();
            $table->integer('nivel_agua_id')->unsigned();
            $table->timestamps();

            $table->foreign('nivel_agua_id')
                  ->references('id')
                  ->on('niveles_agua')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('nivel_agua_registros');
    }
}
