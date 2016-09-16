<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql-turnos')->create('turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('fecha')->index();
            $table->time('hora')->index();
            $table->boolean('atendido')->default(false);
            $table->text('observaciones')->nullable();

            // Relacion con usuarios
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('public.usuarios')
                  ->onDelete('cascade');

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
        Schema::connection('pgsql-turnos')->drop('turnos');
    }
}
