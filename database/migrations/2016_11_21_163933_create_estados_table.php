<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('solicitudes')->create('estados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->mediumText('descripcion')->nullable();
            $table->string('color')->nullable();
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
        Schema::connection('solicitudes')->dropIfExists('estados');
    }
}
