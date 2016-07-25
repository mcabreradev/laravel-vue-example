<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelAguaPlantaRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_agua_planta_registros', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('registrado_el')->unique();
            $table->integer('nivel_agua_planta_id')->unsigned();
            $table->timestamps();

            $table->foreign('nivel_agua_planta_id')
                  ->references('id')
                  ->on('nivel_agua_plantas')
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
        Schema::drop('nivel_agua_planta_registros');
    }
}
