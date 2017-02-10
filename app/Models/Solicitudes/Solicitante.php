<?php

namespace App\Models\Solicitudes;

use App\Models\AppModel;

class Solicitante extends AppModel
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
    protected $table = 'solicitantes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'apellido', 'es_titular', 'telefono', 'celular', 'email'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre'     => 'string',
        'apellido'   => 'string',
        'es_titular' => 'boolean',
        'telefono'   => 'string',
        'celular'    => 'string',
        'email'      => 'string',
    ];

    /**
     *  Las solicitudes (reclamos) del solicitante
     *
     * @return [type] [description]
     */
    public function solicitud()
    {
        return $this->hasMany('App\Models\Solicitudes\Solicitud');
    }
}
