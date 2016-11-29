<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFechasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('turnos')->create('fechas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->timestamps();

            // Relacion con actividades
            $table->integer('actividad_id')->unsigned();
            $table->foreign('actividad_id')
                  ->references('id')
                  ->on('actividades')
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
        Schema::connection('turnos')->drop('fechas');
    }
}
