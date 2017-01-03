<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Estado;

class SolicitudesEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            'nombre' => 'En proceso',
            'color' => '#ffeb3b'
        ]);

        Estado::create([
            'nombre' => 'Realizado',
            'color' => '#4caf50'
        ]);

        Estado::create([
            'nombre' => 'Cerrado',
            'color' => '#00bcd4'
        ]);

    } //run
}
