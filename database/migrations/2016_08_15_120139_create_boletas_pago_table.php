<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletasPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletas_pago', function (Blueprint $table) {
            $table->increments('id');

            $table->string('factura_tipo');
            $table->bigInteger('factura_numero')->unsigned();
            $table->string('factura_periodo');
            $table->date('factura_fecha');

            $table->bigInteger('nro_liq_sp')->unsigned();
            $table->bigInteger('numero_cuenta')->unsigned();
            $table->bigInteger('expediente')->unsigned();

            $table->string('razon_social');
            $table->string('ocupante')->nullable();

            $table->bigInteger('unidad_numero')->unsigned();
            $table->string('unidad_calle')->nullable();
            $table->integer('unidad_numero_puerta')->unsigned()->nullable();
            $table->string('unidad_piso')->nullable();
            $table->string('unidad_departamento')->nullable();

            $table->string('envio_calle')->nullable();
            $table->integer('envio_numero_puerta')->unsigned()->nullable();
            $table->string('envio_piso')->nullable();
            $table->string('envio_departamento')->nullable();


            $table->date('fecha_vencimiento_1');
            $table->decimal('monto_vencimiento_1');
            $table->date('fecha_vencimiento_2');
            $table->decimal('monto_vencimiento_2');
            $table->date('fecha_vencimiento_3');
            $table->decimal('monto_vencimiento_3');

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
        Schema::drop('boletas_pago');
    }
}
