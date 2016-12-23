<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDerivacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('solicitudes')->create('derivaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('derivado_el');
            $table->mediumText('observaciones')->nullable();

            $table->integer('solicitud_id')->unsigned()->nullable();
            $table->foreign('solicitud_id')
                  ->references('id')
                  ->on('solicitudes')
                  ->onDelete('cascade');

            $table->integer('area_id')->unsigned()->nullable();
            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('cascade');

            $table->integer('agente_id')->unsigned()->nullable();
            $table->foreign('agente_id')
                  ->references('id')
                  ->on('agentes')
                  ->onDelete('cascade');

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
        Schema::connection('solicitudes')->dropIfExists('derivaciones');
    }
}
