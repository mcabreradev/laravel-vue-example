<?php

namespace App\Models\Solicitudes;

use App\Models\AppModel;

class Derivacion extends AppModel
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
    protected $table = 'derivaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'derivado_el',
        'observaciones',
        'solicitud_id',
        'area_id',
        'agente_id',
    ];

    /**
     * [solicitud description]
     * @return [type] [description]
     */
    public function solicitud()
    {
        return $this->belongsTo('App\Models\Solicitudes\Solicitud');
    }

    /**
     * [area description]
     * @return [type] [description]
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Solicitudes\Derivaciones\Area');
    }

    /**
     * [agente description]
     * @return [type] [description]
     */
    public function agente()
    {
        return $this->belongsTo('App\Models\Solicitudes\Derivaciones\Agente');
    }
}
