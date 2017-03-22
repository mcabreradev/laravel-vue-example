<?php

namespace App\Contracts;

Interface DpossApiContract
{
    public function getUltimasBoletas($expediente, $unidad);

    public function getBoletasPorPeriodo($expediente, $unidad, $periodo);
}
