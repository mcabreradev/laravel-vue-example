<?php

namespace App\Models\Solicitudes;

use Carbon\Carbon;
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
     * [$dates description]
     * @var [type]
     */
    protected $dates = ['created_at', 'updated_at', 'derivado_el'];

    /**
     * [setDerivadoElAttribute description]
     * @param [type] $date [description]
     */
    public function setDerivadoElAttribute($date){
        $this->attributes['derivado_el'] = $date == "" ? Carbon::now() : Carbon::parse($date);
    }

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
        return $this->belongsTo('App\Models\Solicitudes\Area');
    }

    /**
     * [agente description]
     * @return [type] [description]
     */
    public function agente()
    {
        return $this->belongsTo('App\Models\Solicitudes\Agente');
    }
}
