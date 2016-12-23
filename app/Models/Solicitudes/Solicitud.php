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

    protected $dates = ['created_at', 'updated_at'];

    // protected $dateFormat = 'Y-m-d';

    public function getCreadoElAttribute($date){
        return date_format(date_create($date),"d-m-Y");
    }

    public function setCreadoElAttribute($date){
        $this->attributes['creado_el'] = Carbon::parse($date);
    }

    public function origen()
    {
        return $this->belongsTo('App\Models\Solicitudes\Origen');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Models\Solicitudes\Tipo');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\Solicitudes\Estado');
    }

    public function prioridad()
    {
        return $this->belongsTo('App\Models\Solicitudes\Prioridad');
    }

    public function solicitante()
    {
        return $this->belongsTo('App\Models\Solicitudes\Solicitante');
    }
}
