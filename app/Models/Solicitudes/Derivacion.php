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
     * Setea la solicitud por defecto
     *
     * @param {int} $value
     */
    public function setSolicitudIdAttribute($value){
        $this->attributes['solicitud_id'] = $value == "" ? null : $value;
    }

    /**
     * Setea el area por defecto
     *
     * @param {int} $value
     */
    public function setAreaIdAttribute($value){
        $this->attributes['area_id'] = $value == "" ? null : $value;
    }

    /**
     * Setea el agente por defecto
     *
     * @param {int} $value
     */
    public function setAgenteIdAttribute($value){
        $this->attributes['agente_id'] = $value == "" ? null : $value;
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

    /**
     * Usuario creador
     *
     * @return {Collection}
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Admin\user');
    }
}
