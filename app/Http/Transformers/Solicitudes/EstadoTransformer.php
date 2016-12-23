<?php

namespace App\Http\Transformers\Solicitudes;

use App\Models\Solicitudes\Estado;
use League\Fractal\TransformerAbstract;

class EstadoTransformer extends TransformerAbstract
{
  public function transform(Estado $estado)
  {

    return $estado;
  }
}
