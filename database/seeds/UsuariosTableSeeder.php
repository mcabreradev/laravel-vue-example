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
        $usuario = new Usuario();
        $usuario->dni = 32769403;
        $usuario->nombre = 'Leonel';
        $usuario->apellido = 'Viera';
        $usuario->telefono = '2901476919';
        $usuario->email = 'vieraleonel1@gmail.com';
        $usuario->save();

        $usuario = new Usuario();
        $usuario->dni = 26072626;
        $usuario->nombre = 'Federico';
        $usuario->apellido = 'Gonzalez';
        $usuario->telefono = '2901529764';
        $usuario->email = 'fedegonzal@gmail.com';
        $usuario->save();        
    }
}
