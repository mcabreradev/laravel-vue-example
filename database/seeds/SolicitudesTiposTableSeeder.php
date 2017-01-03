<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Tipo;

class SolicitudesTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create([
            'nombre' => 'Perdida'
        ]);

        Tipo::create([
            'nombre' => 'Medidores'
        ]);

        Tipo::create([
            'nombre' => 'Cloaca'
        ]);

        Tipo::create([
            'nombre' => 'Interna'
        ]);

        Tipo::create([
            'nombre' => 'Veredas'
        ]);

        Tipo::create([
            'nombre' => 'Otros'
        ]);


    } //run
}
