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
    protected $fillable = ['nombre', 'apellido', 'documento', 'telefono', 'celular', 'email'];

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
