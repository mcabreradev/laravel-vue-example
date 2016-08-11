<?php

namespace App\Models\Geo;

use Carbon\Carbon;
use App\Models\AppModel;

class Barrio extends AppModel
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'geometria' => 'object'
    ];

    /**
     * [alertaDetalles description]
     * @return [type] [description]
     */
    public function alertaDetalles()
    {
        return $this->hasMany('App\Models\Alertas\AlertaDetalle');
    }

    /**
     * [alertasVigentes description]
     * @return [type] [description]
     */
    public function alertasVigentes()
    {
        $nowStr = Carbon::now()->toDateTimeString();
        return $this->belongsToMany('App\Models\Alertas\Alerta', 'alerta_detalles')
            ->where('inicia_el', '<=', $nowStr)
            ->where('finaliza_el', '>=', $nowStr)
            ->orderBy('inicia_el', 'asc')
            ->withPivot('alertas_estado_id');
    }

    /**
     * [alertasFuturas description]
     * @return [type] [description]
     */
    public function alertasFuturas()
    {
        $nowStr = Carbon::now()->toDateTimeString();
        return $this->belongsToMany('App\Models\Alertas\Alerta', 'alerta_detalles')
            ->where('inicia_el', '>=', $nowStr)
            ->orderBy('inicia_el', 'asc')
            ->withPivot('alertas_estado_id');
    }
}
