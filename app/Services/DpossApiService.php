<?php

namespace App\Services;

use App\Contracts\DpossApiContract;
use GuzzleHttp\Client;

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

        // @TODO agregar campos "calculados": domicilio, factura, nomenclatura
        return collect(json_decode($response->getBody()));
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
