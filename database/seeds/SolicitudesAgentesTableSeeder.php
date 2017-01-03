<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Agente;

class SolicitudesAgentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agente::create([
            'nombre' => 'Azcona',
            'apellido' => 'Azcona',
        ]);

        Agente::create([
            'nombre' => 'Batista',
            'apellido' => 'Batista',
        ]);

        Agente::create([
            'nombre' => 'Aguilar',
            'apellido' => 'Aguilar',
        ]);

    } //run
}
