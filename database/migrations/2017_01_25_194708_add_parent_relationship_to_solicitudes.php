<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentRelationshipToSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {
            // relacion padre
            $table->integer('padre_id')
                ->unsigned()
                ->nullable()
                ->index();

            $table->foreign('padre_id')
                  ->references('id')
                  ->on('solicitudes')
                  ->onDelete('set null');
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
            $table->dropForeign(['padre_id']);
            $table->dropColumn('padre_id');
        });
    }
}
