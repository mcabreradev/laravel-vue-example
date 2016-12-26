<?php

namespace App\Transformers\Solicitudes;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class AgenteTransformer extends TransformerAbstract
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
            "id"=> $resource->id,
            "nombre"=> $resource->nombre,
            "apellido"=> $resource->apellido,
            "nombre_completo"=> "{$resource->apellido}, {$resource->nombre}",
            "legajo"=> $resource->legajo,
            "telefono"=> $resource->telefono,
            "email"=> $resource->email,
            "created_at"=> $resource->created_at,
            "updated_at"=> $resource->updated_at
        ];

    }
}
