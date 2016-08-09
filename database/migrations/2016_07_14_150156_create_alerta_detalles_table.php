<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertaDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerta_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('barrio_id')->unsigned();
            $table->integer('alerta_id')->unsigned();
            $table->integer('alertas_estado_id')->unsigned();
            $table->timestamps();

            $table->foreign('barrio_id')
                ->references('id')
                ->on('barrios')
                ->onDelete('cascade');

            $table->foreign('alerta_id')
                ->references('id')
                ->on('alertas')
                ->onDelete('cascade');

            $table->foreign('alertas_estado_id')
                ->references('id')
                ->on('alertas_estados')
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
        Schema::drop('alerta_detalles');
    }
}
