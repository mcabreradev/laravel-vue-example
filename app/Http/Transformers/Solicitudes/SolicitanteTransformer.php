<?php

namespace App\Http\Transformers\Solicitudes;

use App\Models\Solicitudes\Solicitante;
use League\Fractal\TransformerAbstract;

class SolicitanteTransformer extends TransformerAbstract
{
  public function transform(Solicitante $solicitante)
  {

    return $solicitante;
  }
}
