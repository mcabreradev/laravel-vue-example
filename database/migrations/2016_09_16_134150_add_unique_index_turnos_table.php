<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueIndexTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('turnos')->table('turnos', function (Blueprint $table) {
            $table->unique(['actividad_id', 'fecha', 'hora'], 'unique_turno');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('turnos')->table('turnos', function (Blueprint $table) {
            $table->dropUnique('unique_turno');
        });
    }
}
