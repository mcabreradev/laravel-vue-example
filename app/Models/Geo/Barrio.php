<?php

namespace App\Models\Geo;

use App\Models\AppModel;

class Barrio extends AppModel
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'geometria' => 'object'
    ];

    public function barriosSituaciones()
    {
        return $this->hasMany('App\Models\Cortes\BarrioSituacion');
    }
}
