<?php

use Illuminate\Database\Seeder;
use App\Models\Alertas\NivelAgua;

class NivelAguaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NivelAgua::create([
            'titulo'      => 'Menos del 15%',
            'color'       => '#CA3A27',
            'descripcion' => 'Se ruega optimizar al máximo el consumo'
        ]);

        NivelAgua::create([
            'titulo'      => 'Menos del 25%',
            'color'       => '#FF8000',
            'descripcion' => 'Se ruega optimizar el consumo. Baja presión generalizada'
        ]);

        NivelAgua::create([
            'titulo'      => 'Menos del 50%',
            'color'       => '#D9D900',
            'descripcion' => 'Servicio funcionando normalmente'
        ]);

        NivelAgua::create([
            'titulo'      => 'Más del 60%',
            'color'       => '#59B200',
            'descripcion' => 'Servicio funcionando normalmente'
        ]);

        NivelAgua::create([
            'titulo'      => 'Más del 80%',
            'color'       => '#59B200',
            'descripcion' => 'Servicio funcionando normalmente'
        ]);
    }
}
