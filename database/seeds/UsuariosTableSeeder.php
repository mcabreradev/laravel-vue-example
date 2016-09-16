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
            'documento' => 32769403,
            'nombre'    => 'Leonel',
            'apellido'  => 'Viera',
            'email'     => 'vieraleonel1@gmail.com'
        ]);

        Usuario::create([
            'documento' => 26072626,
            'apellido'  => 'González',
            'nombre'    => 'Federico',
            'email'     => 'fedegonzal@gmail.com'
        ]);
    }
}
