<?php

namespace App\Http\Transformers\Solicitudes;

use App\Models\Solicitudes\Solicitud;
use League\Fractal\TransformerAbstract;

class SolicitudesTransformer extends TransformerAbstract
{
  public function transform(Solicitud $solicitud)
  {

    return $solicitud;
  }
}
