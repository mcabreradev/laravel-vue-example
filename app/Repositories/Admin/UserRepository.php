<?php

namespace App\Repositories\Admin;

use App\Contracts\DpossApiContract;
use App\Models\Admin\User;
use Carbon\Carbon;
use StdClass;

class UserRepository
{
    protected $api = null;

    public function __construct(DpossApiContract $api)
    {
        $this->api = $api;
    }

    /**
     * [getEstadoCuenta description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function estadoFacturas(User $user)
    {
        $api = $this->api;
        $estadoFacturas = (object) [
            'porPagar'      => 0,
            'vencidas'      => 0,
        ];

        $api->manyHistoricoFacturas($user->conexiones()->get())
            ->each(function($factura) use (&$estadoFacturas, $api) {

                if (! $api->facturaIsPagada($factura)) {
                    if ($api->facturaIsVencida($factura)) {
                        $estadoFacturas->vencidas++;
                    }
                    else {
                        $estadoFacturas->porPagar++;
                    }
                }
            });

        return $estadoFacturas;
    }

    /**
     * [deudaTotal description]
     * @return [type] [description]
     */
    public function deudaTotal(User $user)
    {
        return $this->api->manyEstadoDeuda($user->conexiones()->get())
            ->reduce(function ($carry, $deuda) {
                return $carry + $deuda->monto;
            }, 0);
    }
}
