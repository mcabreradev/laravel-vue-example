<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Localidad;

class LocalidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Localidad::create([
            'nombre' => 'Ushuaia'
        ]);

        Localidad::create([
            'nombre' => 'Tolhuin'
        ]);
    } //run
}
