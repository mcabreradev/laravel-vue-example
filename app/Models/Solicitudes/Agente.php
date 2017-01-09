<?php

namespace App\Models\Solicitudes;

use App\Models\AppModel;

class Agente extends AppModel
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
    protected $table = 'agentes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'legajo',
        'telefono',
        'email',
        'nombre_completo'
    ];

    public function getNombreCompletoAttribute()
    {
        return $this->apellido . ', ' . $this->nombre;
    }

    /**
     * [derivaciones description]
     * @return [type] [description]
     */
    public function derivaciones()
    {
        return $this->hasMany('App\Models\Solicitudes\Derivaciones\Derivacion', 'agente_id');
    }
}
