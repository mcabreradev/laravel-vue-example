<?php

use Illuminate\Database\Seeder;
use App\Models\Cortes\Estado;

class CortesEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            'titulo' => 'Servicio normal',
            'color'  => '#59B200'
        ]);

        Estado::create([
            'titulo' => 'Baja presión',
            'color'  => '#D9D900'
        ]);

        Estado::create([
            'titulo' => 'Servicio interrumpido',
            'color'  => '#CA3A27'
        ]);
    } //run
}
