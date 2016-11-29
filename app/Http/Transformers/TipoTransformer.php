<?php

namespace App\Http\Transformers;

use App\Models\Solicitudes\Tipo;
use League\Fractal\TransformerAbstract;

class TipoTransformer extends TransformerAbstract
{
  public function transform(Tipo $prioridad)
  {

    return $prioridad;
  }
}
