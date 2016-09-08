<?php

namespace App\Models\Turnos;

use App\Models\AppModel;

class Turno extends AppModel
{
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
    protected $fillable = ['fecha', 'hora', 'atendido'];

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
