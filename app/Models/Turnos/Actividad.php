<?php

namespace App\Models\Turnos;

use App\Models\AppModel;

class Actividad extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'actividades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * @return [type] [description]
     */
    public function fechas()
    {
        return $this->hasMany('App\Models\Turnos\Fecha');
    }

    /**
     * @return [type] [description]
     */
    public function turnos()
    {
        return $this->hasMany('App\Models\Turnos\Turno');
    }
}
