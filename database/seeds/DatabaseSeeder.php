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
        $this->call(UsersTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        $this->call(PedidosTableSeeder::class);
        $this->call(PedidoAdjuntosTableSeeder::class);
        $this->call(NivelAguaPlantasTableSeeder::class);
        $this->call(BarriosTableSeeder::class);
        $this->call(CortesEstadosTableSeeder::class);
    }
}
