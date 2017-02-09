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
            'nombre' => 'Gerencia Redes'
        ]);
        Area::create([
            'nombre' => 'Área Operativa y Técnica'
        ]);
        Area::create([
            'nombre' => 'Dirección Comercial'
        ]);
        Area::create([
            'nombre' => 'Departamento Instalaciones Internas'
        ]);
        Area::create([
            'nombre' => 'Presidencia'
        ]);
        Area::create([
            'nombre' => 'Dirección Provincial'
        ]);
        Area::create([
            'nombre' => 'Laboratorio'
        ]);
        Area::create([
            'nombre' => 'Dirección Explotación'
        ]);

    } //run
}
