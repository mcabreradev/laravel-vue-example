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
            $table->string('origen');
            $table->string('tipo');
            $table->string('metodo_entrega');
            $table->string('localidad');
            $table->string('domicilio');
            $table->string('nomenclatura')->nullable();
            $table->boolean('prioritario')->default(false);
            $table->text('descripcion')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('motivo_cancelacion')->nullable();
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
