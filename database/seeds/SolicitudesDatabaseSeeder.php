<?php

use Illuminate\Database\Seeder;

class SolicitudesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SolicitudesAgentesTableSeeder::class);
        $this->call(SolicitudesAreasTableSeeder::class);
        $this->call(SolicitudesEstadosTableSeeder::class);
        $this->call(SolicitudesOrigenesTableSeeder::class);
        $this->call(SolicitudesPrioridadesTableSeeder::class);
        $this->call(SolicitudesTiposTableSeeder::class);
        $this->call(LocalidadesTableSeeder::class);
    }
}
