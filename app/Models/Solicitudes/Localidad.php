<?php

namespace App\Models\Solicitudes;

use App\Models\AppModel;

class Localidad extends AppModel
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
    protected $table = 'localidades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     *  Las solicitudes (reclamos)
     *
     * @return [type] [description]
     */
    public function solicitud()
    {
        return $this->hasMany('App\Models\Solicitudes\Solicitud');
    }
}
