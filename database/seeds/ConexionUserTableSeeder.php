<?php

use App\Models\Admin\User;
use Illuminate\Database\Seeder;
use App\Models\OficinaVirtual\Conexion;

class ConexionUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::where('email', 'admin@app.com')->first();
        $webUser = User::where('email', 'web@app.com')->first();

        $conexion = Conexion::create([
            'expediente' => '19401',
            'unidad'     => '26792',
            'domicilio'  => 'GABRIEL GARCIA MARQUEZ 4466'
        ]);
        $conexion->users()->attach([$adminUser->id, $webUser->id]);

        $conexion = Conexion::create([
            'expediente' => '247',
            'unidad'     => null,
            'domicilio'  => ''
        ]);
        $conexion->users()->attach([$adminUser->id, $webUser->id]);
    }
}
