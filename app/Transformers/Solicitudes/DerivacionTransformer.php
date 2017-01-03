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
            'derivado_el'         => $resource->derivado_el->format('d-m-Y'),
            'observaciones'       => $resource->observaciones,
            'solicitud_id'        => $resource->solicitud_id,
            'solicitud'           => [
                'descripcion'     => $resource->solicitud->descripcionid,
                'origen'          => [
                    'id'          => $resource->solicitud->origen->id,
                    'nombre'      => $resource->solicitud->origen->nombre,
                ],
                'tipo'            => [
                    'id'          => $resource->solicitud->tipo->id,
                    'nombre'      => $resource->solicitud->tipo->nombre,
                ],
                'estado'          => [
                    'id'          => $resource->solicitud->estado->id,
                    'nombre'      => $resource->solicitud->estado->nombre,
                ],
                'prioridad'       => [
                    'id'          => $resource->solicitud->prioridad->id,
                    'nombre'      => $resource->solicitud->prioridad->nombre,
                ],
                'solicitante'     => [
                    'id'          => $resource->solicitud->solicitante->id,
                    'nombre'      => $resource->solicitud->solicitante->nombre,
                    'apellido'    => $resource->solicitud->solicitante->apellido,
                'nombre_completo' => $resource->solicitud->solicitante->apellido . ', '.$resource->solicitud->solicitante->nombre,
                ],
            ],
            'area_id'             => $resource->area_id,
            'area'                => [
                'nombre'          => $resource->area->nombre,
            ],
            'agente_id'           => $resource->agente_id,
            'agente'              => [
                'nombre'          => $resource->agente->nombre,
                'apellido'        => $resource->agente->apellido,
                'nombre_completo' => $resource->agente->apellido . ', '.$resource->agente->nombre,
                'legajo'          => $resource->agente->legajo,
            ]
        ];
    }
}
