<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditNullableFieldsBoletasPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boletas_pago', function (Blueprint $table) {
            $table->bigInteger('unidad_numero')
                ->unsigned()
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boletas_pago', function (Blueprint $table) {
            $table->bigInteger('unidad_numero')
                ->unsigned()
                ->change();
        });
    }
}
