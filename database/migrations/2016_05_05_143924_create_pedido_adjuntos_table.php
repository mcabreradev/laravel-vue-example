<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidoAdjuntosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedido_adjuntos', function(Blueprint $table) {
			$table->bigIncrements('id');
            $table->string('titulo');
            $table->string('path');
            $table->bigInteger('pedido_id')->unsigned();
            $table->timestamps();

            $table->foreign('pedido_id')
                  ->references('id')
                  ->on('pedidos')
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
		Schema::drop('pedido_adjuntos');
	}

}
