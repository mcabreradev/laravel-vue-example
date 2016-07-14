<?php

use Illuminate\Database\Seeder;
use App\Models\Plantas\NivelAguaPlanta;

class NivelAguaPlantasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NivelAguaPlanta::create([
            'etiqueta'    => 'bajo',
            'titulo'      => 'Menos del 15%',
            'descripcion' => 'Se ruega optimizar al máximo el consumo'
        ]);

        NivelAguaPlanta::create([
            'etiqueta'    => 'precaución',
            'titulo'      => 'Menos del 25%',
            'descripcion' => 'Se ruega optimizar el consumo. Baja presión generalizada'
        ]);

        NivelAguaPlanta::create([
            'etiqueta'    => 'bueno',
            'titulo'      => 'Mas del 50%',
            'descripcion' => 'Servicio funcionando normalmente'
        ]);

        NivelAguaPlanta::create([
            'etiqueta'    => 'excelente',
            'titulo'      => 'Más del 75%',
            'descripcion' => 'Servicio funcionando normalmente'
        ]);
    }
}
