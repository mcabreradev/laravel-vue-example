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

            $table->bigInteger('solicitud_id')->unsigned()->nullable()->index();
            $table->foreign('solicitud_id')
                  ->references('id')
                  ->on('solicitudes')
                  ->onDelete('cascade');

            $table->integer('area_id')->unsigned()->nullable()->index();
            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('restrict');

            $table->integer('agente_id')->unsigned()->nullable()->index();
            $table->foreign('agente_id')
                  ->references('id')
                  ->on('agentes')
                  ->onDelete('restrict');

            // usuario que creo la derivacion
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('public.usuarios')
                  ->onDelete('restrict');

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
