<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCortesBarriosSituacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cortes_barrios_situaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('barrio_id')->unsigned();
            $table->integer('cortes_situacion_id')->unsigned();
            $table->integer('cortes_estado_id')->unsigned();
            $table->timestamps();

            $table->foreign('barrio_id')
                ->references('id')
                ->on('barrios')
                ->onDelete('cascade');

            $table->foreign('cortes_situacion_id')
                ->references('id')
                ->on('cortes_situaciones')
                ->onDelete('cascade');

            $table->foreign('cortes_estado_id')
                ->references('id')
                ->on('cortes_estados')
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
        Schema::drop('cortes_barrios_situaciones');
    }
}
