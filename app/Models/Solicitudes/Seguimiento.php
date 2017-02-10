<?php

namespace App\Models\Solicitudes;

use Carbon\Carbon;
use App\Models\AppModel;

class Seguimiento extends AppModel
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
    protected $table = 'seguimientos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'generado_el',
        'descripcion',
        'solicitud_id',
    ];

    /**
     * [$dates description]
     * @var [type]
     */
    protected $dates = ['created_at', 'updated_at', 'generado_el'];

    /**
     * [setGeneradoElAttribute description]
     * @param [type] $date [description]
     */
    public function setGeneradoElAttribute($date){
        $this->attributes['generado_el'] = $date == "" ? Carbon::now() : Carbon::parse($date);
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
     * Usuario creador
     *
     * @return {Collection}
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Admin\user');
    }
}
