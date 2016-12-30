<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('solicitudes')->create('seguimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('generado_el');
            $table->mediumText('descripcion');

            $table->integer('solicitud_id')->unsigned()->nullable();
            $table->foreign('solicitud_id')
                  ->references('id')
                  ->on('solicitudes')
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
        Schema::connection('solicitudes')->dropIfExists('seguimientos');
    }
}
