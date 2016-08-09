<?php

namespace App\Models\Alertas;

use App\Models\AppModel;

class Estado extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alertas_estados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'color'];

    /**
     * [barriosSituaciones description]
     * @return [type] [description]
     */
    public function AlertaDetalles()
    {
        return $this->hasMany('App\Models\Alertas\AlertaDetalle', 'alerta_estado_id');
    }
}
