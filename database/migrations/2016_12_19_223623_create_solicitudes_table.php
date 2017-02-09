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
            $table->datetime('creado_el');
            $table->mediumText('descripcion')->nullable();
            $table->mediumText('observaciones')->nullable();
            $table->json('checklist')->nullable();

            $table->integer('expediente')->unsigned()->nullable();
            $table->integer('unidad')->unsigned()->nullable();
            $table->string('nomenclatura')->nullable();
            $table->decimal('lat', 10, 6)->nullable();
            $table->decimal('lng', 10, 6)->nullable();
            $table->string('lugar_calle')->nullable();
            $table->string('lugar_numero')->nullable();
            $table->string('lugar_entre_1')->nullable();
            $table->string('lugar_entre_2')->nullable();
            $table->string('lugar_barrio')->nullable();
            $table->mediumText('lugar_observaciones')->nullable();


            // relacion padre
            $table->integer('padre_id')->unsigned()->nullable()->index();
            $table->foreign('padre_id')
                  ->references('id')
                  ->on('solicitudes')
                  ->onDelete('set null');

            $table->integer('origen_id')->unsigned()->nullable()->index();
            $table->foreign('origen_id')
                  ->references('id')
                  ->on('origenes')
                  ->onDelete('restrict');

            $table->integer('tipo_id')->unsigned()->nullable()->index();
            $table->foreign('tipo_id')
                  ->references('id')
                  ->on('tipos')
                  ->onDelete('restrict');

            $table->integer('localidad_id')->unsigned()->index();
            $table->foreign('localidad_id')
                ->references('id')
                ->on('localidades')
                ->onDelete('restrict');

            $table->integer('estado_id')->unsigned()->nullable()->index();
            $table->foreign('estado_id')
                  ->references('id')
                  ->on('estados')
                  ->onDelete('restrict');

            $table->integer('prioridad_id')->unsigned()->nullable()->index();
            $table->foreign('prioridad_id')
                  ->references('id')
                  ->on('prioridades')
                  ->onDelete('restrict');

            $table->integer('solicitante_id')->unsigned()->nullable()->index();
            $table->foreign('solicitante_id')
                  ->references('id')
                  ->on('solicitantes')
                  ->onDelete('restrict');

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
