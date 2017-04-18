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
 *     --- campo "'D'": D=debitos, F=facturas
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
            'timeout'  => 10,
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

    protected function addComputedDeudaFields($deuda)
    {
        $deuda->fecha_format = Carbon::createFromFormat('Y-m-d', $deuda->fecha)->format('d/m/Y');
        $deuda->monto_format = '$ ' . number_format($deuda->monto, 2, ',' , '.' );
        $deuda->posibles_punitorios_format = '$ ' . number_format($deuda->posibles_punitorios, 2, ',' , '.' );

        if ($deuda->periodo) {
            $deuda->periodo_format = Carbon::createFromFormat('Ym', $deuda->periodo)->format('m/Y');
        }

        if ($deuda->{"'D'"} === 'F') {
            $deuda->motivo = "Factura {$deuda->periodo_format}";
        }
        else {
            $deuda->motivo = "Nota de débito {$deuda->numero_nota}";
        }


        return $deuda;
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

            $response->map(function ($i) use ($self) {
                return $self->addComputedDeudaFields($i);
            });

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
    public function getUltimasBoletas($expediente, $unidad=null)
    {
        $response = null;
        $self = $this;

        try {
            if ($unidad === null) {
                $response = $this->client
                    ->request('POST', 'usuarios', [
                        'json' => [
                            'numero_expediente' => $expediente
                        ]
                    ]);
            }
            else {
                $response = $this->client
                    ->request('POST', 'usuarios', [
                        'json' => [
                            'numero_unidad' => $unidad
                        ]
                    ]);
            }

            if ($response->getStatusCode() !== 200) {
                throw new Exception('Error al obtener los datos', 1);
            }

            $response = collect(json_decode($response->getBody()));

            $response->map(function ($i) use ($self) {
                return $self->addComputedFacturaFields($i);
            });

        } catch (Exception $e) {
            $response = collect([]);
        }

        return $response;
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
