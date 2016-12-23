<?php

namespace App\Http\Transformers\Solicitudes;

use App\Models\Solicitudes\Tipo;
use League\Fractal\TransformerAbstract;

class TipoTransformer extends TransformerAbstract
{
  public function transform(Tipo $tipo)
  {

    return $tipo;
  }
}
