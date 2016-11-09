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
     * Alertas del dia
     * @return Collection Alertas del dia
     */
    public function alertasHoy()
    {
        $now         = Carbon::now();

        $now->hour   = 0;
        $now->minute = 0;
        $now->second = 0;
        $todayStart  = $now->toDateTimeString();

        $now->hour   = 23;
        $now->minute = 59;
        $now->second = 59;
        $todayEnd    = $now->toDateTimeString();

        return $this->belongsToMany('App\Models\Alertas\Alerta', 'alerta_detalles')
            ->where(function($query) use ($todayStart, $todayEnd) {
                $query->where('inicia_el', '>=', $todayStart)
                      ->where('inicia_el', '<=', $todayEnd);
            })
            ->orWhere(function($query) use ($todayStart, $todayEnd) {
                $query->where('finaliza_el', '>=', $todayStart)
                      ->where('finaliza_el', '<=', $todayEnd);
            })
            ->orderBy('inicia_el', 'asc')
            ->withPivot('alertas_estado_id');
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
