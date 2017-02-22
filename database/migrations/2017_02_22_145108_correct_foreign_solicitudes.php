<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CorrectForeignSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('public.users')
                  ->onDelete('restrict');
        });

        Schema::connection('solicitudes')->table('derivaciones', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('public.users')
                  ->onDelete('restrict');
        });

        Schema::connection('solicitudes')->table('seguimientos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('public.users')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::connection('solicitudes')->table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('public.usuarios')
                  ->onDelete('restrict');
        });

        Schema::connection('solicitudes')->table('derivaciones', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('public.usuarios')
                  ->onDelete('restrict');
        });

        Schema::connection('solicitudes')->table('seguimientos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('public.usuarios')
                  ->onDelete('restrict');
        });
    }
}
