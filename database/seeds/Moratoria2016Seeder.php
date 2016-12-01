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

        Fecha::create(['fecha' => '2016-12-01', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-02', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-12-05', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-06', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-07', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-12-12', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-13', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-14', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-15', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-16', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-12-19', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-20', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-21', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-22', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-23', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-12-26', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-27', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-28', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-29', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-12-30', 'actividad_id' => $actividad->id]);
    } //run
}
