<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateItegridadReferencial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Arreglo el tipo del campo lugar_numero que estaba como string
         * Para que dropee la columna necesito hacer dos closures
         */
        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {
            $table->dropColumn('lugar_numero');
        });
        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {
            $table->integer('lugar_numero')->unsigned()->nullable();
        });


        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {

            $table->dropForeign(['origen_id']);
            $table->foreign('origen_id')
                  ->references('id')
                  ->on('origenes')
                  ->onDelete('restrict');

            $table->dropForeign(['tipo_id']);
            $table->foreign('tipo_id')
                  ->references('id')
                  ->on('tipos')
                  ->onDelete('restrict');

            $table->dropForeign(['estado_id']);
            $table->foreign('estado_id')
                  ->references('id')
                  ->on('estados')
                  ->onDelete('restrict');

            $table->dropForeign(['prioridad_id']);
            $table->foreign('prioridad_id')
                  ->references('id')
                  ->on('prioridades')
                  ->onDelete('restrict');

            $table->dropForeign(['solicitante_id']);
            $table->foreign('solicitante_id')
                  ->references('id')
                  ->on('solicitantes')
                  ->onDelete('restrict');
        });

        Schema::connection('solicitudes')->table('derivaciones', function (Blueprint $table) {

            $table->dropForeign(['area_id']);
            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('restrict');

            $table->dropForeign(['agente_id']);
            $table->foreign('agente_id')
                  ->references('id')
                  ->on('agentes')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {
            $table->dropColumn('lugar_numero');
        });
        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {
            $table->string('lugar_numero')->nullable();
        });

        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['origen_id']);
            $table->foreign('origen_id')
                  ->references('id')
                  ->on('origenes')
                  ->onDelete('cascade');

            $table->dropForeign(['tipo_id']);
            $table->foreign('tipo_id')
                  ->references('id')
                  ->on('tipos')
                  ->onDelete('cascade');

            $table->dropForeign(['estado_id']);
            $table->foreign('estado_id')
                  ->references('id')
                  ->on('estados')
                  ->onDelete('cascade');

            $table->dropForeign(['prioridad_id']);
            $table->foreign('prioridad_id')
                  ->references('id')
                  ->on('prioridades')
                  ->onDelete('cascade');

            $table->dropForeign(['solicitante_id']);
            $table->foreign('solicitante_id')
                  ->references('id')
                  ->on('solicitantes')
                  ->onDelete('cascade');
        });

        Schema::connection('solicitudes')->table('derivaciones', function (Blueprint $table) {

            $table->dropForeign(['area_id']);
            $table->foreign('area_id')
                  ->references('id')
                  ->on('areas')
                  ->onDelete('cascade');

            $table->dropForeign(['agente_id']);
            $table->foreign('agente_id')
                  ->references('id')
                  ->on('agentes')
                  ->onDelete('cascade');
        });
    }
}
