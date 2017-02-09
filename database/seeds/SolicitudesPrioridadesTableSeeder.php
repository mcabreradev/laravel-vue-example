<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Prioridad;

class SolicitudesPrioridadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prioridad::create([
            'nombre' => 'Baja'
        ]);

        Prioridad::create([
            'nombre' => 'Media'
        ]);

        Prioridad::create([
            'nombre' => 'Alta'
        ]);

    } //run
}
