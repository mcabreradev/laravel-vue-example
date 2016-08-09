<?php

namespace App\Models\Alertas;

use App\Models\AppModel;

class AlertaDetalle extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alerta_detalles';

    /**
     * [barrio description]
     * @return [type] [description]
     */
    public function barrio()
    {
        return $this->belongsTo('App\Models\Geo\Barrio');
    }

    /**
     * [estado description]
     * @return [type] [description]
     */
    public function estado()
    {
        return $this->belongsTo('App\Models\Alertas\Estado', 'alerta_estado_id');
    }

    /**
     * [alerta description]
     * @return [type] [description]
     */
    public function alerta()
    {
        return $this->belongsTo('App\Models\Alertas\Alerta');
    }
}
