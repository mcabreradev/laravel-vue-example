<?php

namespace App\Repositories\Alertas;

use App\Models\Alertas\Alerta;
use Carbon\Carbon;
use StdClass;

class AlertaRepository
{
    /**
     * Busca si hay alertas vigentes o futuras para catalogar el estdado actual
     * y futuro del servicio
     * @return StdClass
     */
    public static function estadoServicio()
    {
        $estadoServicio = new StdClass();
        $nowStr = Carbon::now()->toDateTimeString();

        $vigentes = Alerta::where('inicia_el', '<=', $nowStr)
            ->where('finaliza_el', '>=', $nowStr)
            ->take(1)
            ->get()
            ->count();

        $futuras = Alerta::where('inicia_el', '>=', $nowStr)
            ->take(1)
            ->get()
            ->count();

        $estadoServicio->vigente             = ($vigentes > 0 ? 'Algunos barrios afectados' : 'Funcionando normalmente');
        $estadoServicio->vigente_has_alertas = $vigentes > 0;
        $estadoServicio->futuro              = ($futuras > 0 ? 'Algunos barrios afectados' : 'Sin inconvenientes');
        $estadoServicio->futuro_has_alertas  = $futuras > 0;

        return $estadoServicio;
    }
}
