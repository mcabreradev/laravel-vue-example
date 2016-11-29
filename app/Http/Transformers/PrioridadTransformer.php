<?php

namespace App\Http\Transformers;

use App\Models\Solicitudes\Prioridad;
use League\Fractal\TransformerAbstract;

class PrioridadTransformer extends TransformerAbstract
{
  public function transform(Prioridad $prioridad)
  {

    return $prioridad;
  }
}
