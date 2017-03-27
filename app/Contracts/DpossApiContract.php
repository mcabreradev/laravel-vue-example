<?php

namespace App\Contracts;

/**
 * @see  App\Services\DpossApiService
 */
Interface DpossApiContract
{
    public function getUltimasBoletas($expediente, $unidad);
    public function getManyUltimasBoletas($conexiones);
    public function getUltimasBoletasPorPeriodo($expediente, $unidad, $periodo);
    public function getUltimasBoletasImpagas($expediente, $unidad);
    public function getManyUltimasBoletasImpagas($conexiones);
    public function boletaIsImpaga($boleta);
    public function getBoletaMontoActual($boleta);
}
