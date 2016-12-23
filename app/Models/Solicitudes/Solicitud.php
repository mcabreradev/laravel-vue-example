<?php

namespace App\Models\Solicitudes;

use Carbon\Carbon;
use App\Models\AppModel;

class Solicitud extends AppModel
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
    protected $table = 'solicitudes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion',
        'creado_el',
        'observaciones',
        'lat',
        'lng',
        'lugar_calle',
        'lugar_numero',
        'lugar_entre_1',
        'lugar_entre_2',
        'lugar_observaciones',
        'origen_id',
        'tipo_id',
        'estado_id',
        'prioridad_id',
        'solicitante_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * [$dates description]
     * @var [type]
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * [getCreadoElAttribute description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getCreadoElAttribute($date){
        return date_format(date_create($date),"d-m-Y");
    }

    /**
     * [setCreadoElAttribute description]
     * @param [type] $date [description]
     */
    public function setCreadoElAttribute($date){
        $this->attributes['creado_el'] = Carbon::parse($date);
    }

    /**
     * [origen description]
     * @return [type] [description]
     */
    public function origen()
    {
        return $this->belongsTo('App\Models\Solicitudes\Origen');
    }

    /**
     * [tipo description]
     * @return [type] [description]
     */
    public function tipo()
    {
        return $this->belongsTo('App\Models\Solicitudes\Tipo');
    }

    /**
     * [estado description]
     * @return [type] [description]
     */
    public function estado()
    {
        return $this->belongsTo('App\Models\Solicitudes\Estado');
    }

    /**
     * [prioridad description]
     * @return [type] [description]
     */
    public function prioridad()
    {
        return $this->belongsTo('App\Models\Solicitudes\Prioridad');
    }

    /**
     * [solicitante description]
     * @return [type] [description]
     */
    public function solicitante()
    {
        return $this->belongsTo('App\Models\Solicitudes\Solicitante');
    }

    /**
     * [derivaciones description]
     * @return [type] [description]
     */
    public function derivaciones()
    {
        return $this->hasMany('App\Models\Solicitudes\Derivaciones\Derivacion', 'solicitud_id');
    }
}
