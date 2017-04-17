<?php

namespace App\Contracts;

/**
 * @see  App\Services\DpossApiService
 */
Interface DpossApiContract
{
    public function historicoFacturas($expediente, $unidad=null);
    public function manyHistoricoFacturas($conexiones);
    public function facturaIsPagada($factura);
    public function facturaIsVencida($factura);

    public function estadoDeuda($expediente, $unidad=null);

    public function getUltimasBoletas($expediente, $unidad=null);
    public function getUltimasBoletasPorPeriodo($expediente, $unidad, $periodo);
    public function getBoletaMontoActual($boleta);
}
