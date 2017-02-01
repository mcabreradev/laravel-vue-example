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
        $ret = [
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
            'derivaciones'        => isSetOrNull($resource->derivaciones),
            'seguimientos'        => isSetOrNull($resource->seguimientos),
            'relacionados'        => $resource->relacionados()->get()
        ];

        // ultima derivacion
        $derivacion = $resource->derivacion()->with('area', 'agente')->first();
        if ($derivacion) {
            $ret['derivacion'] = [
                'id'            => $derivacion->id,
                'derivado_el'   => $derivacion->derivado_el->format('Y-m-d H:i:s'),
                'observaciones' => $derivacion->observaciones,
                'area'          => ($derivacion->area ? $derivacion->area->nombre : null),
                'agente'        => ($derivacion->agente ? $derivacion->agente->nombre : null),
            ];
        } else {
            $ret['derivacion'] =  [
                "id"              => null,
                "derivado_el"     => null,
                "observaciones"   => null,
                "area"            => null,
                "agente"          => null
            ];
        }

        return $ret;
    }

}
