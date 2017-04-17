<?php

namespace App\Services;

use App\Contracts\DpossApiContract;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;

/*
 * Documentacion informal de la API provista por DPOSS:
 *
 * La URL base es http://remotos.dposs.gob.ar:150, dominio que sólo es resuelto
 * desde el servidor que aloja http://dposs.gob.ar
 *
 * Las operaciones disponibles son:
 *
 * - POST /usuarios : devuelve las ultimas 5 boletas en un array.
 *   -- Content-Type: application/json
 *
 *   -- Parametros: todos los parametros se pasan en el body como un objeto json
 *      de tipo clave valor.
 *     --- numero_expediente: nro de expediente de la conexion. Puede veolver
 *         mas de 5 resultados porque puede incluir mas de 1 unidad
 *
 *     --- numero_unidad: nro de unidad de la conexion. Deberia devolver siempre
 *        cinco resultados porque es el mas especifico
 *
 *     --- numero_cienta: nro de cuenta. Puede devolver mas de 5 resultados porque
 *         puede incluir varios exptes y unidades.
 *
 *   -- Los parametros son excluyentes (pueden pasarse varios pero solo
 *      interpretara 1) y debe especificarse al menos uno de ellos
 *
 *
 *
 * - GET /calles/{nombreBuscado} : devuelve un array con las calles del sistema
 *   interno de la DPOSS que coincidan con el route-param {nombreBuscado}
 *   -- Content-Type: application/json
 *
 *
 *
 * - POST /expedientes/historico : duelve el historico (array) completo de
 *   facturas para una conexion.
 *   -- Content-Type: application/json
 *
 *   -- Parametros: acepta un json en el body con el numero de expediente
 *      y unidad. Es obligatorio. Ejemplos:
 *      {"expediente": "2187", "unidad": "17433"}
 *      {"expediente": "2187", "unidad": "null"}
 *      La idea es que devuelve todas las facturas de un expediente y, de forma
 *      adicional, se puede filtrar mas fino por unidad.
 *
 *
 *
 * - POST /expedientes/estado-de-deuda : devuelve el histórico (array) de deudas
 *   para una conexion. Incluye facturas, notas de debito, debitos, creditos...
 *   -- Content-Type: application/json
 *
 *   -- Parametros: acepta un json en el body con el numero de expediente
 *      y unidad. Es obligatorio. Ejemplos:
 *      {"expediente": "2187", "unidad": "17433"}
 *      {"expediente": "2187", "unidad": "null"}
 *      La idea es que devuelve todas las "deudas" de un expediente y, de forma
 *      adicional, se puede filtrar mas fino por unidad.
 *
 *   -- Algunas aclaraciones sobre los datos devueltos:
 *     --- campos "monto" y "saldo": ambos deberian ser identicos e indican lo que falta pagar.
 *     --- campo "posibles_punitorios": serian como los intereses por mora
 *     --- campo "'D'": A|B=facturas, ND=notas de debito, D=debitos, F=facturas
 *     --- campo "tipo_nota": A|B=facturas, D|X=debitos
 */

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

    protected function addComputedFacturaFields($factura)
    {
        $factura->domicilio = $factura->unidad_calle . ' ' .$factura->unidad_numero_puerta . ''. ($factura->unidad_piso > 0 ? ' '.$factura->unidad_piso : '') . ''. ($factura->unidad_departamento > 0 ? ' '.$factura->unidad_departamento : '');
        $factura->factura = $factura->factura_tipo . ' '. $factura->nro_liq_sp;
        $factura->nomenclatura = $factura->nomenclatura_seccion . ' '. $factura->nomenclatura_manzana . ' '. $factura->nomenclatura_parcela . ''. ($factura->nomenclatura_subparcela != null ? ' '.$factura->nomenclatura_subparcela:''). ''. ($factura->nomenclatura_unidad_funcional != null ? ' '.$factura->nomenclatura_unidad_funcional:'');
        $factura->periodo = Carbon::parse($factura->periodo_factura.'01')->format('m/Y');
        $factura->titular = $factura->nombre_razon_social;
        $factura->vencimiento1 = Carbon::parse($factura->fecha_vencimiento_1)->format('d/m/Y') . ' - $' . number_format($factura->monto_total_origen, 2, ',' , '.' );
        $factura->vencimiento2 = Carbon::parse($factura->fecha_vencimiento_2)->format('d/m/Y') . ' - $' . number_format($factura->monto_vencimiento_2, 2, ',' , '.' );
        $factura->vencimiento3 = Carbon::parse($factura->fecha_vencimiento_3)->format('d/m/Y') . ' - $' . number_format($factura->monto_vencimiento_3, 2, ',' , '.' );
        $factura->buscar_por = $factura->numero_unidad != null ? ['tipo' => 'unidad', 'valor' => $factura->numero_unidad] : ['tipo' => 'expediente', 'valor' => $factura->expediente];

        // status
        if ($factura->saldo == 0) {
            $factura->status = 'Pagado';
        } else {
            $now = Carbon::now();
            $ultVen = Carbon::parse($factura->fecha_vencimiento_3);

            $factura->status = $now->gt($ultVen) ? 'Vencida': 'Descargar';
        }

        return $factura;
    }

    /**
     * Consulta el historico completo de facturas de un expediente. Tambien
     * se puede filtrar mas fino por unidad
     *
     * @param  [type] $expediente [description]
     * @param  [type] $unidad     [description]
     * @return [type]             [description]
     */
    public function historicoFacturas($expediente, $unidad=null)
    {
        $response = null;
        $self = $this;

        try {
            $apiResponse = $this->client
                ->request('POST', 'expedientes/historico', [
                    'json' => [
                        'expediente' => $expediente,
                        'unidad'     => ($unidad ?: 'null')
                    ]
                ]);

            if ($apiResponse->getStatusCode() !== 200) {
                throw new Exception('Error al obtener los datos', 1);
            }

            $response = collect(json_decode($apiResponse->getBody()));

            $response->map(function ($i) use ($self) {
                return $self->addComputedFacturaFields($i);
            });

        } catch (Exception $e) {
            $response = collect([]);
        }

        return $response;
    }

    /**
     * [getManyUltimasBoletas description]
     * @param  [type] $conexiones [description]
     * @return [type]             [description]
     */
    public function manyHistoricoFacturas($conexiones)
    {
        $facturas = collect([]);

        $conexiones->each(function($conexion) use (&$facturas) {
            $facturas = $facturas->merge($this->historicoFacturas($conexion->expediente, $conexion->unidad));
        });

        return $facturas;
    }

    /**
     * Consulta las deudas de un expediente. TSe puede filtrar mas fino por unidad
     *
     * @param  [type] $expediente [description]
     * @param  [type] $unidad     [description]
     * @return [type]             [description]
     */
    public function estadoDeuda($expediente, $unidad=null)
    {
        $response = null;
        $self = $this;

        try {
            $apiResponse = $this->client
                ->request('POST', 'expedientes/estado-de-deuda', [
                    'json' => [
                        'expediente' => $expediente,
                        'unidad'     => ($unidad ?: 'null')
                    ]
                ]);

            if ($apiResponse->getStatusCode() !== 200) {
                throw new Exception('Error al obtener los datos', 1);
            }

            $response = collect(json_decode($apiResponse->getBody()));

        } catch (Exception $e) {
            $response = collect([]);
        }

        return $response;
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
            // if ($expediente == 247) {
            //     $response = collect(json_decode('[{"factura_tipo":"B","factura_numero":4528673,"nro_liq_sp":760086,"numero_cuenta":18820912,"nombre_razon_social":"LIU ZHIJIANG","nombre_ocupante":null,"dni_ocupante":0,"unidad_calle":null,"unidad_numero_puerta":null,"unidad_piso":null,"unidad_departamento":null,"envio_calle":null,"envio_numero_puerta":null,"envio_piso":null,"envio_departamento":null,"nomenclatura_seccion":null,"nomenclatura_manzana":null,"nomenclatura_parcela":null,"nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":247,"numero_unidad":null,"periodo_factura":"201703","monto_total_origen":12185.3,"fecha_vencimiento_1":"2017-04-10","monto_vencimiento_2":12299,"fecha_vencimiento_2":"2017-04-17","monto_vencimiento_3":12412.7,"fecha_vencimiento_3":"2017-04-24","fecha_factura":"2017-03-20","saldo":12185.3},{"factura_tipo":"B","factura_numero":4489021,"nro_liq_sp":714652,"numero_cuenta":18820912,"nombre_razon_social":"LIU ZHIJIANG","nombre_ocupante":"DEPARTAMENTO","dni_ocupante":0,"unidad_calle":"GOBERNADOR PAZ","unidad_numero_puerta":157,"unidad_piso":"001","unidad_departamento":"A","envio_calle":"GOBERNADOR PAZ","envio_numero_puerta":157,"envio_piso":"001","envio_departamento":"A","nomenclatura_seccion":"A","nomenclatura_manzana":"0031","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":247,"numero_unidad":289,"periodo_factura":"201702","monto_total_origen":556.92,"fecha_vencimiento_1":"2017-03-10","monto_vencimiento_2":562.12,"fecha_vencimiento_2":"2017-03-17","monto_vencimiento_3":567.31,"fecha_vencimiento_3":"2017-03-24","fecha_factura":"2017-01-20","saldo":0},{"factura_tipo":"B","factura_numero":4432561,"nro_liq_sp":650141,"numero_cuenta":18820912,"nombre_razon_social":"LIU ZHIJIANG","nombre_ocupante":"DEPARTAMENTO","dni_ocupante":0,"unidad_calle":"GOBERNADOR PAZ","unidad_numero_puerta":157,"unidad_piso":"001","unidad_departamento":"A","envio_calle":"GOBERNADOR PAZ","envio_numero_puerta":157,"envio_piso":"001","envio_departamento":"A","nomenclatura_seccion":"A","nomenclatura_manzana":"0031","nomenclatura_parcela":"0004","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":247,"numero_unidad":289,"periodo_factura":"201611","monto_total_origen":360.03,"fecha_vencimiento_1":"2016-12-12","monto_vencimiento_2":360.91,"fecha_vencimiento_2":"2016-12-19","monto_vencimiento_3":361.79,"fecha_vencimiento_3":"2016-12-26","fecha_factura":"2016-11-12","saldo":0}]'));
            // } else {
            //     $response = collect(json_decode('[{"factura_tipo":"B","factura_numero":4526893,"nro_liq_sp":758259,"numero_cuenta":12725,"nombre_razon_social":"MUNICIPALIDAD DE USHUAIA CON OCUPANTE","nombre_ocupante":"SOLER ESTEBAN","dni_ocupante":27826494,"unidad_calle":"GABRIEL GARCIA MARQUEZ","unidad_numero_puerta":4466,"unidad_piso":"0","unidad_departamento":"0","envio_calle":"GABRIEL GARCIA MARQUEZ","envio_numero_puerta":4466,"envio_piso":"0","envio_departamento":"0","nomenclatura_seccion":"Q","nomenclatura_manzana":"003H","nomenclatura_parcela":"0025","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":19401,"numero_unidad":26792,"periodo_factura":"201703","monto_total_origen":628.74,"fecha_vencimiento_1":"2017-04-10","monto_vencimiento_2":634.61,"fecha_vencimiento_2":"2017-04-17","monto_vencimiento_3":640.47,"fecha_vencimiento_3":"2017-04-24","fecha_factura":"2017-03-18","saldo":628.74},{"factura_tipo":"B","factura_numero":4506711,"nro_liq_sp":732342,"numero_cuenta":12725,"nombre_razon_social":"MUNICIPALIDAD DE USHUAIA CON OCUPANTE","nombre_ocupante":"SOLER ESTEBAN","dni_ocupante":27826494,"unidad_calle":"GABRIEL GARCIA MARQUEZ","unidad_numero_puerta":4466,"unidad_piso":"0","unidad_departamento":"0","envio_calle":"GABRIEL GARCIA MARQUEZ","envio_numero_puerta":4466,"envio_piso":"0","envio_departamento":"0","nomenclatura_seccion":"Q","nomenclatura_manzana":"003H","nomenclatura_parcela":"0025","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":19401,"numero_unidad":26792,"periodo_factura":"201702","monto_total_origen":628.74,"fecha_vencimiento_1":"2017-03-10","monto_vencimiento_2":634.61,"fecha_vencimiento_2":"2017-03-17","monto_vencimiento_3":640.47,"fecha_vencimiento_3":"2017-03-24","fecha_factura":"2017-01-20","saldo":628.74},{"factura_tipo":"B","factura_numero":4446789,"nro_liq_sp":664369,"numero_cuenta":12725,"nombre_razon_social":"MUNICIPALIDAD DE USHUAIA CON OCUPANTE","nombre_ocupante":"SOLER ESTEBAN","dni_ocupante":27826494,"unidad_calle":"GABRIEL GARCIA MARQUEZ","unidad_numero_puerta":4466,"unidad_piso":"0","unidad_departamento":"0","envio_calle":"GABRIEL GARCIA MARQUEZ","envio_numero_puerta":4466,"envio_piso":"0","envio_departamento":"0","nomenclatura_seccion":"Q","nomenclatura_manzana":"003H","nomenclatura_parcela":"0025","nomenclatura_subparcela":null,"nomenclatura_unidad_funcional":null,"expediente":19401,"numero_unidad":26792,"periodo_factura":"201611","monto_total_origen":398.88,"fecha_vencimiento_1":"2016-12-12","monto_vencimiento_2":399.85,"fecha_vencimiento_2":"2016-12-19","monto_vencimiento_3":400.83,"fecha_vencimiento_3":"2016-12-26","fecha_factura":"2016-11-12","saldo":0}]'));
            // }


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

            $response->map(function ($i) use ($self) {
                return $self->addComputedFacturaFields($i);
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
                return (! $this->facturaIsPagada($boleta));
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
     * Determina si una factura esta pagada
     * @param  StdClass $factura factura de pago a revisar
     * @return bool
     */
    public function facturaIsPagada($factura)
    {
        return $factura->status === 'Pagado';
    }

    /**
     * Determina si una factura esta vencida
     * @param  StdClass $factura factura de pago a revisar
     * @return bool
     */
    public function facturaIsVencida($factura)
    {
        return $factura->status === 'Vencida';
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
