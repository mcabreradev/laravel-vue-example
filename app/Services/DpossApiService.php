<?php

namespace App\Services;

use App\Contracts\DpossApiContract;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;

class DpossApiService implements DpossApiContract
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Constructor
     */
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
        try {
            $response = null;

            // TEMPORALMENTE PARA EVITAR CAIDAS
            if ($expediente == 247) {
                $response = collect(json_decode('[{"factura_tipo":"B","factura_numero":4528673,"nro_liq_sp":760086,"numero_cuenta":18820912,"nombre_razon_social":"LIU ZHIJIANG","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":null,"unidad_numero_puerta":null,"unidad_piso":null,"unidad_departamento":null,"envio_calle":null,"envio_numero_puerta":null,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":null,"nomenclatura_manzana":null,"nomenclatura_parcela":null,"nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":247,"numero_unidad":null,"periodo_factura":"201703","monto_total_origen":12185.3,"fecha_vencimiento_1":"2017-04-10","monto_vencimiento_2":12299,"fecha_vencimiento_2":"2017-04-17","monto_vencimiento_3":12412.7,"fecha_vencimiento_3":"2017-04-24","fecha_factura":"2017-03-20","saldo":12185.3},{"factura_tipo":"B","factura_numero":4489021,"nro_liq_sp":714652,"numero_cuenta":18820912,"nombre_razon_social":"LIU ZHIJIANG","nombre_ocupante":"DEPARTAMENTO","dni_ocupante":0,"unidad_calle":"GOBERNADOR PAZ","unidad_numero_puerta":157,"unidad_piso":"001","unidad_departamento":"A","envio_calle":"GOBERNADOR PAZ","envio_numero_puerta":157,"envio_piso":"001","envio_departamento":"A","nomenclatura_seccion":"A","nomenclatura_manzana":"0031","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":247,"numero_unidad":289,"periodo_factura":"201702","monto_total_origen":556.92,"fecha_vencimiento_1":"2017-03-10","monto_vencimiento_2":562.12,"fecha_vencimiento_2":"2017-03-17","monto_vencimiento_3":567.31,"fecha_vencimiento_3":"2017-03-24","fecha_factura":"2017-01-20","saldo":0},{"factura_tipo":"B","factura_numero":4432561,"nro_liq_sp":650141,"numero_cuenta":18820912,"nombre_razon_social":"LIU ZHIJIANG","nombre_ocupante":"DEPARTAMENTO","dni_ocupante":0,"unidad_calle":"GOBERNADOR PAZ","unidad_numero_puerta":157,"unidad_piso":"001","unidad_departamento":"A","envio_calle":"GOBERNADOR PAZ","envio_numero_puerta":157,"envio_piso":"001","envio_departamento":"A","nomenclatura_seccion":"A","nomenclatura_manzana":"0031","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":247,"numero_unidad":289,"periodo_factura":"201611","monto_total_origen":360.03,"fecha_vencimiento_1":"2016-12-12","monto_vencimiento_2":360.91,"fecha_vencimiento_2":"2016-12-19","monto_vencimiento_3":361.79,"fecha_vencimiento_3":"2016-12-26","fecha_factura":"2016-11-12","saldo":0}]'));
            } else {
                $response = collect(json_decode('[{"factura_tipo":"B","factura_numero":4526893,"nro_liq_sp":758259,"numero_cuenta":12725,"nombre_razon_social":"MUNICIPALIDAD DE USHUAIA CON OCUPANTE","nombre_ocupante":"SOLER ESTEBAN","dni_ocupante":27826494,"unidad_calle":"GABRIEL GARCIA MARQUEZ","unidad_numero_puerta":4466,"unidad_piso":"0","unidad_departamento":"0","envio_calle":"GABRIEL GARCIA MARQUEZ","envio_numero_puerta":4466,"envio_piso":"0","envio_departamento":"0","nomenclatura_seccion":"Q","nomenclatura_manzana":"003H","nomenclatura_parcela":"0025","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":19401,"numero_unidad":26792,"periodo_factura":"201703","monto_total_origen":628.74,"fecha_vencimiento_1":"2017-04-10","monto_vencimiento_2":634.61,"fecha_vencimiento_2":"2017-04-17","monto_vencimiento_3":640.47,"fecha_vencimiento_3":"2017-04-24","fecha_factura":"2017-03-18","saldo":628.74},{"factura_tipo":"B","factura_numero":4506711,"nro_liq_sp":732342,"numero_cuenta":12725,"nombre_razon_social":"MUNICIPALIDAD DE USHUAIA CON OCUPANTE","nombre_ocupante":"SOLER ESTEBAN","dni_ocupante":27826494,"unidad_calle":"GABRIEL GARCIA MARQUEZ","unidad_numero_puerta":4466,"unidad_piso":"0","unidad_departamento":"0","envio_calle":"GABRIEL GARCIA MARQUEZ","envio_numero_puerta":4466,"envio_piso":"0","envio_departamento":"0","nomenclatura_seccion":"Q","nomenclatura_manzana":"003H","nomenclatura_parcela":"0025","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":19401,"numero_unidad":26792,"periodo_factura":"201702","monto_total_origen":628.74,"fecha_vencimiento_1":"2017-03-10","monto_vencimiento_2":634.61,"fecha_vencimiento_2":"2017-03-17","monto_vencimiento_3":640.47,"fecha_vencimiento_3":"2017-03-24","fecha_factura":"2017-01-20","saldo":628.74},{"factura_tipo":"B","factura_numero":4446789,"nro_liq_sp":664369,"numero_cuenta":12725,"nombre_razon_social":"MUNICIPALIDAD DE USHUAIA CON OCUPANTE","nombre_ocupante":"SOLER ESTEBAN","dni_ocupante":27826494,"unidad_calle":"GABRIEL GARCIA MARQUEZ","unidad_numero_puerta":4466,"unidad_piso":"0","unidad_departamento":"0","envio_calle":"GABRIEL GARCIA MARQUEZ","envio_numero_puerta":4466,"envio_piso":"0","envio_departamento":"0","nomenclatura_seccion":"Q","nomenclatura_manzana":"003H","nomenclatura_parcela":"0025","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":19401,"numero_unidad":26792,"periodo_factura":"201611","monto_total_origen":398.88,"fecha_vencimiento_1":"2016-12-12","monto_vencimiento_2":399.85,"fecha_vencimiento_2":"2016-12-19","monto_vencimiento_3":400.83,"fecha_vencimiento_3":"2016-12-26","fecha_factura":"2016-11-12","saldo":0}]'));
            }
            /*

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
            */
            $response->map(function ($i) {
                $i->domicilio = $i->unidad_calle . ' ' .$i->unidad_numero_puerta . ''. ($i->unidad_piso > 0 ? ' '.$i->unidad_piso : '') . ''. ($i->unidad_departamento > 0 ? ' '.$i->unidad_departamento : '');
                $i->factura = $i->factura_tipo . ' '. $i->nro_liq_sp;
                $i->nomenclatura = $i->nomenclatura_seccion . ' '. $i->nomenclatura_manzana . ' '. $i->nomenclatura_parcela . ''. ($i->nomenclatura_subparcela != null ? ' '.$i->nomenclatura_subparcela:''). ''. ($i->nomenclatura_unidad_funcional != null ? ' '.$i->nomenclatura_unidad_funcional:'');
                $i->periodo = Carbon::parse($i->periodo_factura.'01')->format('m/Y');
                $i->titular = $i->nombre_razon_social;
                $i->vencimiento1 = Carbon::parse($i->fecha_vencimiento_1)->format('d/m/Y') . ' - $' . number_format($i->monto_total_origen, 2, ',' , '.' );
                $i->vencimiento2 = Carbon::parse($i->fecha_vencimiento_2)->format('d/m/Y') . ' - $' . number_format($i->monto_vencimiento_2, 2, ',' , '.' );
                $i->vencimiento3 = Carbon::parse($i->fecha_vencimiento_3)->format('d/m/Y') . ' - $' . number_format($i->monto_vencimiento_3, 2, ',' , '.' );
                $i->buscar_por = $i->numero_unidad != null ? ['tipo' => 'unidad', 'valor' => $i->numero_unidad] : ['tipo' => 'expediente', 'valor' => $i->expediente];

                // status
                if ($i->saldo == 0) {
                    $i->status = 'Pagado';
                } else {
                    $now = Carbon::now();
                    $ultVen = Carbon::parse($i->fecha_vencimiento_3);

                    $i->status = $now->gt($ultVen) ? 'Vencida': 'Descargar';
                }

                return $i;
            });

            return $response;

        } catch (Exception $e) {
            return collect([]);
        }
    }

    /**
     * Devuelve las boletas para un conjunto de conexiones
     * @param  Collection $conexiones Collection de conexiones
     * @return Collection Colleccion con las boletas. Puede ser []
     */
    public function getManyUltimasBoletas($conexiones)
    {
        $boletas = collect([]);

        $conexiones->each(function($conexion) use (&$boletas) {
            $boletas = $boletas->merge($this->getUltimasBoletas($conexion->expediente, $conexion->unidad));
        });

        return $boletas;
    }

    /**
     * Devuelve las boletas de pago de una conexion, para un periodo
     * @param  int $expediente Numero de expediente
     * @param  int $unidad     Numero de unidad, puede ser null
     * @param  int $periodo    Perido de factura en formato YYYYMM. ej: 201703
     * @return Collection      Colleccion con las boletas. Puede ser []
     */
    public function getUltimasBoletasPorPeriodo($expediente, $unidad, $periodo)
    {
        $boletas = $this->getUltimasBoletas($expediente, $unidad)
            ->filter(function ($value) use ($periodo) {
                return $value->periodo_factura == $periodo;
            });

        return $boletas;
    }

    /**
     * Devuelve las boletas impagas para una conexion
     * @param  int $expediente Numero de expediente
     * @param  int $unidad     Numero de unidad, puede ser null
     * @return Collection      Colleccion con las boletas. Puede ser []
     */
    public function getUltimasBoletasImpagas($expediente, $unidad)
    {
        $boletas = $this->getUltimasBoletas($expediente, $unidad)
            ->filter(function ($boleta) {
                return $this->boletaIsImpaga($boleta);
            });

        return $boletas;
    }

    /**
     * Devuelve las boletas impagas para un conjunto de conexiones
     * @param  Collection $conexiones Collection de conexiones
     * @return Collection      Colleccion con las boletas. Puede ser []
     */
    public function getManyUltimasBoletasImpagas($conexiones)
    {
        $boletas = collect([]);

        $conexiones->each(function($conexion) use (&$boletas) {
            $boletas = $boletas->merge($this->getUltimasBoletasImpagas($conexion->expediente, $conexion->unidad));
        });

        return $boletas;
    }

    /**
     * Determina si una boleta esta impaga. Puede ser por vencimiento o
     * simplemente porque todavia no registra un pago
     * @param  StdClass $boleta Boleta de pago a revisar
     * @return bool
     */
    public function boletaIsImpaga($boleta)
    {
        return ($boleta->status === 'Vencida') || ($boleta->status === 'Descargar');
    }

    /**
     * Obtiene el monto actual segun los distintos vencimientos
     * @param  StdClass $boleta
     * @return int
     */
    public function getBoletaMontoActual($boleta)
    {
        $venc1 = Carbon::parse($boleta->fecha_vencimiento_1);
        $venc2 = Carbon::parse($boleta->fecha_vencimiento_2);
        $now   = Carbon::now();
        $monto = 0;

        if ($now->gt($venc2)) {
            $monto = $boleta->monto_vencimiento_3;
        } else if ($now->gt($venc1)) {
            $monto = $boleta->monto_vencimiento_2;
        } else {
            $monto = $boleta->monto_total_origen;
        }

        return $monto;
    }
}
