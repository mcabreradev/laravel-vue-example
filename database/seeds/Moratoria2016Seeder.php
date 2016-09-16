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
        $actividad = Actividad::create([
            'nombre' => 'Moratoria 2016'
        ]);

        Fecha::create(['fecha' => '2016-09-19', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-09-20', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-09-21', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-09-22', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-09-23', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-09-26', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-09-27', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-09-28', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-09-29', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-09-30', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-10-03', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-04', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-05', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-06', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-07', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-10-10', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-11', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-12', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-13', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-14', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-10-17', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-18', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-19', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-20', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-21', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-10-24', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-25', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-26', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-27', 'actividad_id' => $actividad->id]);
        Fecha::create(['fecha' => '2016-10-28', 'actividad_id' => $actividad->id]);

        Fecha::create(['fecha' => '2016-10-31', 'actividad_id' => $actividad->id]);

        Horario::create([
            'hora'         => '8:30',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '9:00',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '9:30',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '10:00',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '10:30',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '11:00',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '11:30',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '12:00',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '12:30',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

        Horario::create([
            'hora'         => '13:00',
            'actividad_id' => $actividad->id,
            'lunes'        => true,
            'martes'       => true,
            'miercoles'    => true,
            'jueves'       => true,
            'viernes'      => true,
            'sabados'      => false,
            'domingos'     => false
        ]);

    } //run
}
