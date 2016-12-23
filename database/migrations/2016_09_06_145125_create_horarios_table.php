<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('turnos')->create('horarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('hora');
            $table->boolean('lunes')->default(false);
            $table->boolean('martes')->default(false);
            $table->boolean('miercoles')->default(false);
            $table->boolean('jueves')->default(false);
            $table->boolean('viernes')->default(false);
            $table->boolean('sabados')->default(false);
            $table->boolean('domingos')->default(false);
            $table->timestamps();

            // agrego relacion con actividad
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
        Schema::connection('turnos')->dropIfExists('horarios');
    }
}
