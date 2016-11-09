<?php

use App\Models\Turnos\Fecha;
use App\Models\Turnos\Horario;
use Illuminate\Database\Seeder;
use App\Models\Turnos\Actividad;

class Moratoria2016Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actividad = Actividad::first();

        Fecha::create(['fecha' => '2016-11-01', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-22', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-03', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-04', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-11-07', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-08', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-09', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-10', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-11', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-11-14', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-15', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-16', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-17', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-18', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-11-21', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-22', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-23', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-24', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-25', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-11-29', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-11-30', 'actividad_id' => $actividad->id]);
    } //run
}
