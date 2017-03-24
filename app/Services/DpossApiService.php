<?php

namespace App\Services;

use App\Contracts\DpossApiContract;
use GuzzleHttp\Client;
use Carbon\Carbon;

class DpossApiService implements DpossApiContract
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => env('DPOSS_API_BASE'),
            // You can set any number of default request options.
            'timeout'  => 8,
        ]);
    }

    /**
     * Devuelve las ultimas boletas de pago de una conexion
     * @param  int $expediente Numero de expediente
     * @param  int $unidad     Numero de unidad, puede ser null
     * @return Collection      Colleccion con las boletas. Puede ser []
     */
    public function getUltimasBoletas($expediente, $unidad)
    {
        $response = null;

        if ($unidad === null) {
            $response = $this->client->get("expediente/{$expediente}");
        }
        else {
            $response = $this->client->get("unidad/{$unidad}");
        }

        if ($response->getStatusCode() !== 200) {
            return collect([]);
        }

        // @TODO agregar campos "calculados": domicilio, factura, nomenclatura !!!!!!!!!!!!!!!!

        $response = collect(json_decode($response->getBody()));

        $response->map(function ($i) {
            $i->domicilio = $i->unidad_calle . ' ' .$i->unidad_numero_puerta . ''. ($i->unidad_piso > 0 ? ' '.$i->unidad_piso : '') . ''. ($i->unidad_departamento > 0 ? ' '.$i->unidad_departamento : '');
            $i->factura = $i->factura_tipo . ' '. $i->nro_liq_sp;
            $i->nomenclatura = $i->nomenclatura_seccion . ' '. $i->nomenclatura_manzana . ' '. $i->nomenclatura_parcela . ''. ($i->nomenclatura_subparcela != null ? ' '.$i->nomenclatura_subparcela:''). ''. ($i->nomenclatura_unidad_funcional != null ? ' '.$i->nomenclatura_unidad_funcional:'');
            $i->periodo = Carbon::parse($i->periodo_factura.'01')->format('m/Y');
            $i->titular = $i->nombre_razon_social;
            $i->vencimiento1 = Carbon::parse($i->fecha_vencimiento_1)->format('d/m/Y') . ' - $' . $i->monto_total_origen;
            $i->vencimiento2 = Carbon::parse($i->fecha_vencimiento_2)->format('d/m/Y') . ' - $' . $i->monto_vencimiento_2;
            $i->vencimiento3 = Carbon::parse($i->fecha_vencimiento_3)->format('d/m/Y') . ' - $' . $i->monto_vencimiento_3;
            $i->status = ($i->saldo == 0) ? 'Pagado' : (Carbon::now()->format('d/m/Y') > Carbon::parse($i->fecha_vencimiento_3)->format('d/m/Y') ? 'Vencida': 'Descargar');
            $i->buscar_por = $i->numero_unidad != null ? ['tipo' => 'unidad', 'valor' => $i->numero_unidad] : ['tipo' => 'expediente', 'valor' => $i->expediente];

            return $i;
        });

        return $response;
    }

    /**
     * Devuelve las boletas de pago de una conexion, para un periodo
     * @param  int $expediente Numero de expediente
     * @param  int $unidad     Numero de unidad, puede ser null
     * @param  int $periodo    Perido de factura en formato YYYYMM. ej: 201703
     * @return Collection      Colleccion con las boletas. Puede ser []
     */
    public function getBoletasPorPeriodo($expediente, $unidad, $periodo)
    {
        $boletas = $this->getUltimasBoletas($expediente, $unidad)
            ->filter(function ($value, $key) use ($periodo) {
            return $value->periodo_factura == $periodo;
        });

        return $boletas;
    }
}
