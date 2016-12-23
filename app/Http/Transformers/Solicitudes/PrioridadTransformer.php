<?php

namespace App\Http\Transformers\Solicitudes;

use App\Models\Solicitudes\Prioridad;
use League\Fractal\TransformerAbstract;

class PrioridadTransformer extends TransformerAbstract
{
  public function transform(Prioridad $prioridad)
  {

    return $prioridad;
  }
}
