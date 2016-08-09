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

    public function barriosSituaciones()
    {
        return $this->hasMany('App\Models\Cortes\BarrioSituacion');
    }

    public function alertasVigentes()
    {
        $nowStr = Carbon::now()->toDateTimeString();
        return $this->belongsToMany('App\Models\Cortes\Situacion', 'cortes_barrios_situaciones', 'barrio_id', 'cortes_situacion_id')
            ->where('inicia_el', '<=', $nowStr)
            ->where('finaliza_el', '>=', $nowStr)
            ->orderBy('inicia_el', 'asc')
            ->withPivot('cortes_estado_id');
    }
}
