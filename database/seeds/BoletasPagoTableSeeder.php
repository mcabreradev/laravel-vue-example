<?php

use Illuminate\Database\Seeder;
use App\Models\OficinaVirtual\BoletaPago;

class BoletasPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boletasJson = json_decode(Storage::disk('seeds-files')
            ->get('data-import.json'));

        foreach ($boletasJson as $boleta) {
            BoletaPago::create([
                'factura_tipo'         => $boleta->factura_tipo,
                'factura_numero'       => $boleta->factura_numero,
                'factura_periodo'      => $boleta->periodo_factura,
                'factura_fecha'        => $boleta->fecha_factura,

                'nro_liq_sp'           => $boleta->nro_liq_sp,
                'numero_cuenta'        => $boleta->numero_cuenta,
                'expediente'           => $boleta->expediente,

                'razon_social'         => $boleta->nombre_razon_social,
                'ocupante'             => $boleta->nombre_ocupante,

                'unidad_numero'        => $boleta->numero_unidad,
                'unidad_calle'         => $boleta->unidad_calle,
                'unidad_numero_puerta' => $boleta->unidad_numero_puerta,
                'unidad_piso'          => $boleta->unidad_piso,
                'unidad_departamento'  => $boleta->unidad_departamento,

                'envio_calle'          => $boleta->envio_calle,
                'envio_numero_puerta'  => $boleta->envio_numero_puerta,
                'envio_piso'           => $boleta->envio_piso,
                'envio_departamento'   => $boleta->envio_departamento,

                'monto_vencimiento_1'  => $boleta->monto_total_origen,
                'fecha_vencimiento_1'  => $boleta->fecha_vencimiento_1,
                'monto_vencimiento_2'  => $boleta->monto_vencimiento_2,
                'fecha_vencimiento_2'  => $boleta->fecha_vencimiento_2,
                'monto_vencimiento_3'  => $boleta->monto_vencimiento_3,
                'fecha_vencimiento_3'  => $boleta->fecha_vencimiento_3,

                'saldo'                => $boleta->saldo,
            ]);
        }
    }
}
