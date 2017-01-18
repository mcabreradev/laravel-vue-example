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
            "id"                  => $resource->id,
            "descripcion"         => $resource->descripcion,
            "creado_el"           => $resource->creado_el,
            "observaciones"       => $resource->observaciones,
            "lat"                 => $resource->lat,
            "lng"                 => $resource->lng,
            "lugar_calle"         => $resource->lugar_calle,
            "lugar_numero"        => $resource->lugar_numero,
            "lugar_entre_1"       => $resource->lugar_entre_1,
            "lugar_entre_2"       => $resource->lugar_entre_2,
            "lugar_observaciones" => $resource->lugar_observaciones,
            "origen_id"           => $resource->origen_id,
            "origen"              => isSetOrNull($resource->origen),
            "tipo_id"             => $resource->tipo_id,
            "tipo"                => isSetOrNull($resource->tipo),
            "estado_id"           => $resource->estado_id,
            "estado"              => isSetOrNull($resource->estado),
            "prioridad_id"        => $resource->prioridad_id,
            "prioridad"           => isSetOrNull($resource->prioridad),
            "solicitante_id"      => $resource->solicitante_id,
            "solicitante"         => isSetOrNull($resource->solicitante),
        ];
    }
}
