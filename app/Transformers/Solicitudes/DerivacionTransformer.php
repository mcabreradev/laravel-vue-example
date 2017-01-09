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
    protected $availableIncludes   = [];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes     = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform($resource)
    {
        return [
            'id'                  => $resource->id,
            'derivacion_id'       => $resource->id,
            'derivado_el'         => $resource->derivado_el->format('Y-m-d h:m:s'),
            'observaciones'       => $resource->observaciones,
            'solicitud_id'        => $resource->solicitud_id,
            'solicitud'           => [
                'id'              => $resource->solicitud->id,
                'descripcion'     => $resource->solicitud->descripcion,
                'origen'          => isSetOrNull($resource->solicitud->origen),
                'tipo'            => isSetOrNull($resource->solicitud->tipo),
                'estado'          => isSetOrNull($resource->solicitud->estado),
                'prioridad'       => isSetOrNull($resource->solicitud->prioridad),
                'solicitante'     => isSetOrNull($resource->solicitud->solicitante),
            ],
            'area_id'             => $resource->area_id,
            'area'                => isSetOrNull($resource->area),
            'agente_id'           => $resource->agente_id,
            'agente'              => isSetOrNull($resource->agente),
        ];
    }
}
