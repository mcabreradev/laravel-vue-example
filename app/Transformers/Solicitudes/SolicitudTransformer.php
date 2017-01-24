<?php

namespace App\Transformers\Solicitudes;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class SolicitudTransformer extends TransformerAbstract
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
            "id"                  => $resource->id,
            "descripcion"         => $resource->descripcion,
            "creado_el"           => $resource->creado_el,
            "observaciones"       => $resource->observaciones,
            "lat"                 => $resource->lat,
            "lng"                 => $resource->lng,
            "ubicacion"           => $resource->ubicacion,
            "origen"              => isSetOrNull($resource->origen),
            "tipo"                => isSetOrNull($resource->tipo, 'nombre'),
            "estado"              => isSetOrNull($resource->estado),
            "prioridad"           => isSetOrNull($resource->prioridad),
            "solicitante"         => isSetOrNull($resource->solicitante),
            "derivacion"          =>  [
                "id"              => isSetOrNull($resource->derivacion, 'id'),
                "derivado_el"     => isSetOrNull($resource->derivacion, 'derivado_el') !== null ? $resource->derivacion->derivado_el->format('Y-m-d H:i:s') : null,
                "observaciones"   => isSetOrNull($resource->derivacion, 'observaciones'),
                "area"            => isSetOrNull($resource->derivacion, 'area', 'nombre'),
                "agente"          => isSetOrNull($resource->derivacion, 'agente', 'nombre_completo'),
            ]
        ];
    }

}
