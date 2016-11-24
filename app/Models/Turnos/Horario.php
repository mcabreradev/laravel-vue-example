<?php

namespace App\Models\Turnos;

use Carbon\Carbon;
use App\Models\AppModel;

class Horario extends AppModel
{
    public static $DIAS_SEMANA_MAP = [
        0 => 'domingos',
        1 => 'lunes',
        2 => 'martes',
        3 => 'miercoles',
        4 => 'jueves',
        5 => 'viernes',
        6 => 'sabados'
    ];

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'turnos';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'horarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['hora','lunes','martes','miercoles','jueves','viernes','sabados','domingos'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['hora', 'lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabados', 'domingos'];

    /**
     * @return relationship Relacion con actividades
     */
    public function actividad()
    {
        return $this->belongsTo('App\Models\Turnos\Actividad');
    }

    /**
     * [validarDiaSeman description]
     * @return [type] [description]
     */
    public function isFechaValida(Carbon $fecha)
    {
        return $this->getAttribute(static::$DIAS_SEMANA_MAP[$fecha->dayOfWeek]);
    }
}
