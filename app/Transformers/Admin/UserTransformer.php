<?php

namespace App\Transformers\Admin;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class UserTransformer extends TransformerAbstract
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
        $rolesNames = $resource->roles->map(function ($role) {
            return $role->display_name;
        });

        $rolesStr = '';
        foreach ($rolesNames as $name) {
            $rolesStr .= ($rolesStr === '' ? '' : ', ') . $name;
        }

        return [
            'id'    => $resource->id,
            'name'  => $resource->name,
            'email' => $resource->email,
            'roles' => $rolesStr
        ];

    }
}
