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
        $conexion = Conexion::create([
            'expediente' => '19401',
            'unidad'     => '26792',
            'domicilio'  => 'GABRIEL GARCIA MARQUEZ 4466'
        ]);
        $user = User::where('email', 'web@app.com')->first();
        $conexion->users()->attach([$user->id]);
    }
}
