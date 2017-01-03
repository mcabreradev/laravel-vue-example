<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Area;

class SolicitudesAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::create([
            'nombre' => 'Dir. Comercial',
        ]);

        Area::create([
            'nombre' => 'Explotación',
        ]);

        Area::create([
            'nombre' => 'Distribución',
        ]);

        Area::create([
            'nombre' => 'Ingeniería',
        ]);

        Area::create([
            'nombre' => 'Laboratorio',
        ]);

        Area::create([
            'nombre' => 'Medidores',
        ]);

        Area::create([
            'nombre' => 'D.T. Redes',
        ]);

    } //run
}
