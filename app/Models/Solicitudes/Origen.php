<?php

namespace App\Models\Solicitudes;

use App\Models\AppModel;

class Origen extends AppModel
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
    protected $table = 'origenes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'color'];
}
