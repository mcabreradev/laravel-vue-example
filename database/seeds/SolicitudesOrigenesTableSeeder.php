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
            'nombre' => 'Personalmente'
        ]);
        Origen::create([
            'nombre' => 'Email'
        ]);
        Origen::create([
            'nombre' => 'Chat online'
        ]);
        Origen::create([
            'nombre' => 'Whatsapp'
        ]);
        Origen::create([
            'nombre' => 'Mensaje de texto'
        ]);
        Origen::create([
            'nombre' => 'Llamado telefónico'
        ]);
    } //run
}
