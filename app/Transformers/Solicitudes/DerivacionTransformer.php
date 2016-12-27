<?php

namespace App\Transformers\Solicitudes;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class DerivacionTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform($resource)
    {
        return [
            'derivacion_id' => $resource->id,
            'derivado_el'   => $resource->derivado_el->format('d-m-Y'),
            'observaciones' => $resource->observaciones,
            'solicitud_id'  => $resource->solicitud_id,
            'area_id'       => $resource->area_id,
            'agente_id'     => $resource->agente_id,
        ];
    }
}
