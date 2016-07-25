<?php

namespace App\Models\Cortes;

use App\Models\AppModel;

class BarrioSituacion extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cortes_barrios_situaciones';

    public function barrio()
    {
        return $this->belongsTo('App\Models\Geo\Barrio', 'barrio_id');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\Cortes\Estado', 'cortes_estado_id');
    }

    public function situacion()
    {
        return $this->belongsTo('App\Models\Cortes\Situacion', 'cortes_situacion_id');
    }
}
