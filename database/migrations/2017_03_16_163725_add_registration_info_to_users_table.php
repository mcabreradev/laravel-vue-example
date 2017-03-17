<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegistrationInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->table('users', function (Blueprint $table) {
            $table->string('registration_nro_liq_sp')->nullable();
            $table->string('registration_periodo')->nullable();
            $table->string('registration_monto')->nullable();
            $table->string('registration_expediente')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql')->table('users', function (Blueprint $table) {
            $table->dropColumn('registration_nro_liq_sp');
            $table->dropColumn('registration_periodo');
            $table->dropColumn('registration_monto');
            $table->dropColumn('registration_expediente');
        });
    }
}
