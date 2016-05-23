<?php

use Illuminate\Database\Seeder;
use App\Models\OficinaVirtual\Usuario;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'documento' => 20327694031,
            'nombre'    => 'Leonel',
            'apellido'  => 'Viera'
        ]);

        Usuario::create([
            'documento' => 26072626,
            'apellido'  => 'González',
            'nombre'    => 'Federico'
        ]);
    }
}
