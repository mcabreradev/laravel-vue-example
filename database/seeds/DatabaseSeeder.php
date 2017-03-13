<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuariosTableSeeder::class);
        $this->call(PedidosTableSeeder::class);
        $this->call(PedidoAdjuntosTableSeeder::class);
        $this->call(NivelAguaTableSeeder::class);
        $this->call(BarriosTableSeeder::class);
        $this->call(AlertasEstadosTableSeeder::class);
        $this->call(SolicitudesDatabaseSeeder::class);
        $this->call(LaratrustSeeder::class);
    }
}
