<?php

namespace App\Models\Turnos;

use App\Models\AppModel;

class Actividad extends AppModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'pgsql-turnos';

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
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'nombre', 'fechas', 'horarios'];

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
    public function horarios()
    {
        return $this->hasMany('App\Models\Turnos\Horario');
    }

    /**
     * @return [type] [description]
     */
    public function turnos()
    {
        return $this->hasMany('App\Models\Turnos\Turno');
    }

    /**
     * [getCronograma description]
     * @return [type] [description]
     */
    public function getCronograma()
    {
        $cronograma = [];

        // recorro las fechas de la actividad.
        // NOTA: Si el usuario filtro las fechas, recorrera solo las fitradas
        foreach ($this->fechas as $fecha) {
            $fechaCronograma = [];

            // recorro los horarios de la actividad
            // NOTA: Si el usuario filtro los horarios, recorrera solo los fitrados
            foreach ($this->horarios as $horario) {
                // si el horario aplica a la fecha
                if ($horario->isFechaValida($fecha->fecha)) {

                    // @TODO: WORKAROUD
                    if ($fecha->fecha->month === 10 &&
                        $fecha->fecha->day >= 3     &&
                        $fecha->fecha->day <= 7     &&
                        $horario->hora > '10:31') {
                    } else {
                        $fechaCronograma[] = $horario->hora;
                    }
                }
            }

            $cronograma[$fecha->fecha->toDateString()] = $fechaCronograma;
        }

        return $cronograma;
    }

    /**
     * [getTurnosAsignadosMap description]
     * @return [type] [description]
     */
    public function getTurnosAsignadosMap()
    {
        $turnosAsignadosMap = [];

        foreach ($this->turnos as $turno) {
            if (array_key_exists($turno->fecha->toDateString(), $turnosAsignadosMap)) {
                $turnosAsignadosMap[$turno->fecha->toDateString()][$turno->hora] = [
                    'atendido' => $turno->atendido
                ];
            }
            else {
                $turnosAsignadosMap[$turno->fecha->toDateString()] = [
                    $turno->hora => ['atendido' => $turno->atendido]
                ];
            }
        }

        return $turnosAsignadosMap;
    }
}
