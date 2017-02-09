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
            'nombre' => 'David',
            'apellido' => 'Brizuela'
        ]);
        Agente::create([
            'nombre' => 'Carlos',
            'apellido' => 'Gomez'
        ]);
        Agente::create([
            'nombre' => 'Alfredo',
            'apellido' => 'Palma'
        ]);
        Agente::create([
            'nombre' => 'Danisa',
            'apellido' => 'Dolder'
        ]);
        Agente::create([
            'nombre' => 'Jorge',
            'apellido' => 'Garrido'
        ]);
        Agente::create([
            'nombre' => 'Oscar',
            'apellido' => 'Garramuno'
        ]);
        Agente::create([
            'nombre' => 'Raul',
            'apellido' => 'Ferreyra'
        ]);
        Agente::create([
            'nombre' => 'Fabiana',
            'apellido' => 'Albanese'
        ]);
        Agente::create([
            'nombre' => 'Sebastian',
            'apellido' => 'Brunas'
        ]);
        Agente::create([
            'nombre' => 'Javier',
            'apellido' => 'Lepori'
        ]);
        Agente::create([
            'nombre' => 'Diego',
            'apellido' => 'Cerra'
        ]);
        Agente::create([
            'nombre' => 'Leandro',
            'apellido' => 'Galito'
        ]);
        Agente::create([
            'nombre' => 'Ramon',
            'apellido' => 'Azcona'
        ]);
        Agente::create([
            'nombre' => 'Walter',
            'apellido' => 'Batista'
        ]);
        Agente::create([
            'apellido' => 'Municipalidad de Ushuaia'
        ]);

    } //run
}
