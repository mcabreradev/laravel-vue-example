<?php

namespace App\Models\Turnos;

use App\Models\AppModel;

class Turno extends AppModel
{
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
    protected $table = 'turnos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha', 'hora', 'atendido', 'observaciones'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha'];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d';

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'fecha', 'hora', 'atendido', 'usuario', 'actividad', 'observaciones'];

    /**
     * @return [type] [description]
     */
    public function actividad()
    {
        return $this->belongsTo('App\Models\Turnos\Actividad');
    }

    /**
     * @return [type] [description]
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\OficinaVirtual\Usuario');
    }

}
