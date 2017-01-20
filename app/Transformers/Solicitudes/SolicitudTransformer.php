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
            "ubicacion"           => $this->getUbicacion($resource),
            "origen"              => isSetOrNull($resource->origen),
            "tipo"                => isSetOrNull($resource->tipo->nombre),
            "estado"              => isSetOrNull($resource->estado),
            "prioridad"           => isSetOrNull($resource->prioridad),
            "solicitante"         => isSetOrNull($resource->solicitante),
            "derivacion"          => isSetOrNull($resource->derivacion) !== null?[
                "id"   => isSetOrNull($resource->derivacion->id),
                "derivado_el"     => isSetOrNull($resource->derivacion->derivado_el !==null ? $resource->derivacion->derivado_el->format('Y-m-d H:i:s') : null),
                "observaciones"   => isSetOrNull($resource->derivacion->observaciones),
                "area"            => isSetOrNull($resource->derivacion->area->nombre),
                "agente"          => isSetOrNull($resource->derivacion->agente->nombre_completo),
            ]: [
                "derivado_el"     => null,
                "observaciones"   => null,
                "area"            => null,
                "agente"          => null
            ],
        ];
    }

    /**
    *
    *   Metodo custom para obtener la ubicaciones..  parece como cuando estaba junior, esto es muy cabeza.. sorry :(
    */
    public function getUbicacion($resource){
        // Todos los campos cargados
        if(
            (null !== $resource->lugar_calle) &&
            (null !== $resource->lugar_numero) &&
            (null !== $resource->lugar_entre_1) &&
            (null !== $resource->lugar_entre_2) &&
            (null !== $resource->lugar_observaciones)
        ){
            return "{$resource->lugar_calle} {$resource->lugar_numero}, entre {$resource->lugar_entre_1} y {$resource->lugar_entre_2} ({$resource->lugar_observaciones})";
        }

        // Sólo calle y/o nro
        if(
            (null !== $resource->lugar_calle) &&
            (null !== $resource->lugar_numero) &&
            (null === $resource->lugar_entre_1) &&
            (null === $resource->lugar_entre_2) &&
            (null === $resource->lugar_observaciones)
        ){
            return "{$resource->lugar_calle} {$resource->lugar_numero}";
        }

        // Calle y/o nro más observaciones
        if(
            (null !== $resource->lugar_calle) &&
            (null !== $resource->lugar_numero) &&
            (null === $resource->lugar_entre_1) &&
            (null === $resource->lugar_entre_2) &&
            (null !== $resource->lugar_observaciones)
        ){
            return "{$resource->lugar_calle} {$resource->lugar_numero} ({$resource->lugar_observaciones})";
        }

        // Sólo entre
        if(
            (null === $resource->lugar_calle) &&
            (null === $resource->lugar_numero) &&
            (null !== $resource->lugar_entre_1) &&
            (null !== $resource->lugar_entre_2) &&
            (null === $resource->lugar_observaciones)
        ){
            return "entre {$resource->lugar_entre_1} y {$resource->lugar_entre_2}";
        }

        // Entre más observaciones:
        if(
            (null === $resource->lugar_calle) &&
            (null === $resource->lugar_numero) &&
            (null !== $resource->lugar_entre_1) &&
            (null !== $resource->lugar_entre_2) &&
            (null !== $resource->lugar_observaciones)
        ){
            return "entre {$resource->lugar_entre_1} y {$resource->lugar_entre_2} ({$resource->lugar_observaciones})";
        }

        // Sólo observaciones
        if(
            (null === $resource->lugar_calle) &&
            (null === $resource->lugar_numero) &&
            (null === $resource->lugar_entre_1) &&
            (null === $resource->lugar_entre_2) &&
            (null !== $resource->lugar_observaciones)
        ){
            return "({$resource->lugar_observaciones})";
        }
        else{
            return null;
        }
    }
}
