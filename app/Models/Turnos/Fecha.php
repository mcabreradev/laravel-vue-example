<?php

namespace App\Models\Turnos;

use App\Models\AppModel;

class Fecha extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fechas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha'];

    /**
     * @return [type] [description]
     */
    public function actividad()
    {
        return $this->belongsTo('App\Models\Turnos\Actidad');
    }

    /**
     * @return [type] [description]
     */
    public function horarios()
    {
        return $this->hasMany('App\Models\Turnos\Horario');
    }
}
