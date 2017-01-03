<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Origen;

class SolicitudesOrigenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Origen::create([
            'nombre' => 'Teléfono'
        ]);

        Origen::create([
            'nombre' => 'Email'
        ]);

        Origen::create([
            'nombre' => 'Web'
        ]);

        Origen::create([
            'nombre' => 'Whastapp'
        ]);

        Origen::create([
            'nombre' => 'Facebook'
        ]);

        Origen::create([
            'nombre' => 'Twitter'
        ]);

        Origen::create([
            'nombre' => 'Personal'
        ]);


    } //run
}
