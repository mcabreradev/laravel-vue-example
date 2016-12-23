<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('solicitudes')->create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('descripcion');
            $table->datetime('creado_el');
            $table->mediumText('observaciones')->nullable();
            $table->decimal('lat', 8, 6)->nullable();
            $table->decimal('lng', 8, 6)->nullable();

            $table->string('lugar_calle')->nullable();
            $table->string('lugar_numero')->unsigned()->nullable();
            $table->string('lugar_entre_1')->nullable();
            $table->string('lugar_entre_2')->nullable();
            $table->mediumText('lugar_observaciones')->nullable();

            $table->integer('origen_id')->unsigned()->nullable();
            $table->foreign('origen_id')
                  ->references('id')
                  ->on('origenes')
                  ->onDelete('cascade');


            $table->integer('tipo_id')->unsigned()->nullable();
            $table->foreign('tipo_id')
                  ->references('id')
                  ->on('tipos')
                  ->onDelete('cascade');

            $table->integer('estado_id')->unsigned()->nullable();
            $table->foreign('estado_id')
                  ->references('id')
                  ->on('estados')
                  ->onDelete('cascade');

            $table->integer('prioridad_id')->unsigned()->nullable();
            $table->foreign('prioridad_id')
                  ->references('id')
                  ->on('prioridades')
                  ->onDelete('cascade');

            $table->integer('solicitante_id')->unsigned()->nullable();
            $table->foreign('solicitante_id')
                  ->references('id')
                  ->on('solicitantes')
                  ->onDelete('cascade');

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
        Schema::connection('solicitudes')->dropIfExists('solicitudes');
    }
}
