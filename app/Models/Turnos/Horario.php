<?php

namespace App\Models\Turnos;

use App\Models\AppModel;

class Horario extends AppModel
{
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
     * @return [type] [description]
     */
    public function fecha()
    {
        return $this->belongsTo('App\Models\Turnos\Fecha');
    }

}
