<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedidos', function(Blueprint $table) {
			$table->bigIncrements('id');
            $table->string('estado');
            $table->string('tipo');
            $table->string('domicilio');
            $table->string('localidad');
            $table->string('unidad');
            $table->string('macizo');
            $table->string('parcela');
            $table->text('descripcion');
            $table->text('observaciones');
            $table->integer('usuario_id')->unsigned();
            $table->timestamps();

            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('usuarios')
                  ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedidos');
	}

}
