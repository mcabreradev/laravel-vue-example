<?php

use Illuminate\Database\Seeder;
use App\Models\Solicitudes\Tipo;

class SolicitudesTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonComercial = json_encode([
            [
                'label' => 'Nombre del titular',
                'value' => '',
                'type'  => 'text'
            ]
        ]);

        $jsonBajaPresionSinAgua = json_encode([
            [
                'label' => 'Desde cuándo? ( dia / hora aprox)',
                'value' => '',
                'type'  => 'text'
            ],
            [
                'label' => 'Posee medidor?',
                'value' => false,
                'type'  => 'boolean'
            ],
            [
                'label' => 'Cuántas unidades se abastecen desde esa conexión?',
                'value' => '',
                'type'  => 'textarea'
            ],
            [
                'label' => 'Sus vecinos estan en la misma situacion?',
                'value' => '',
                'type'  => 'textarea'
            ],
            [
                'label' => 'Posee tanque?',
                'value' => false,
                'type'  => 'boolean'
            ],
            [
                'label' => 'Pagan el servicio? (pueden tener canilla comunitaria que no garantiza el servicio regularmente)',
                'value' => false,
                'type'  => 'boolean'
            ]
        ]);

        $jsonNoTieneLlaveInterna = json_encode([
            [
                'label' => 'Tiene plomero para coordinar la reparación?',
                'value' => false,
                'type'  => 'boolean'
            ]
        ]);

        $jsonVeredas = json_encode([
            [
                'label' => 'Corroborar si esta en listado de veredas pendientes de realizar( Gerencia Operacion y Desarrolllo)',
                'vale'  => false,
                'type'  => 'boolean'
            ]
        ]);

        Tipo::create([
            'nombre' => 'Pérdida'
        ]);
        Tipo::create([
            'nombre' => 'Falta de suministro',
            'checklist' => $jsonBajaPresionSinAgua
        ]);
        Tipo::create([
            'nombre' => 'Baja presión',
            'checklist' => $jsonBajaPresionSinAgua
        ]);
        Tipo::create([
            'nombre' => 'Medidores'
        ]);
        Tipo::create([
            'nombre' => 'Veredas',
            'checklist' => $jsonVeredas
        ]);
        Tipo::create([
            'nombre' => 'Pérdida interna'
        ]);
        Tipo::create([
            'nombre' => 'Pérdida en via pública'
        ]);
        Tipo::create([
            'nombre' => 'Denuncia por derroche'
        ]);
        Tipo::create([
            'nombre' => 'No recepción de factura',
            'checklist' => $jsonComercial
        ]);
        Tipo::create([
            'nombre' => 'Conexión domiciliaria',
            'checklist' => $jsonNoTieneLlaveInterna,
        ]);
        Tipo::create([
            'nombre' => 'Recambio de conexión',
            'checklist' => $jsonNoTieneLlaveInterna,
        ]);
        Tipo::create([
            'nombre' => 'Catastro',
            'checklist' => $jsonComercial
        ]);
        Tipo::create([
            'nombre' => 'Relevamiento catastral',
            'checklist' => $jsonComercial
        ]);
        Tipo::create([
            'nombre' => 'Otros',
            'checklist' => $jsonComercial
        ]);
        Tipo::create([
            'nombre' => 'Eximir del pago del servicio',
            'checklist' => $jsonComercial
        ]);

    } //run
}
