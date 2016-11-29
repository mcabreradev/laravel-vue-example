<?php

namespace App\Http\Transformers;

use App\Models\Solicitudes\Origen;
use League\Fractal\TransformerAbstract;

class OrigenTransformer extends TransformerAbstract
{
  public function transform(Origen $origen)
  {

    return $origen;
  }
}
