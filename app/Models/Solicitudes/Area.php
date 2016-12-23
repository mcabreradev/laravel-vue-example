<?php

namespace App\Models\Solicitudes;

use App\Models\AppModel;

class Area extends AppModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'solicitudes';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'areas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * [derivaciones description]
     * @return [type] [description]
     */
    public function derivaciones()
    {
        return $this->hasMany('App\Models\Solicitudes\Derivaciones\Derivacion', 'area_id');
    }
}
