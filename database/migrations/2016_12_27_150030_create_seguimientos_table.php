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

            $table->bigInteger('solicitud_id')->unsigned()->nullable()->index();
            $table->foreign('solicitud_id')
                  ->references('id')
                  ->on('solicitudes')
                  ->onDelete('cascade');

            // usuario que creo el seguimiento
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
        Schema::connection('solicitudes')->dropIfExists('seguimientos');
    }
}
