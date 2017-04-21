<?php

namespace App\Repositories\Admin;

use App\Contracts\DpossApiContract;
use App\Models\Admin\User;
use App\Models\OficinaVirtual\Notificacion;
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
            'historico'     => 0,
        ];

        $api->manyHistoricoFacturas($user->conexiones()->get())
            ->each(function($factura) use (&$estadoFacturas, $api) {

                $estadoFacturas->historico++;

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
        $deudaTotal = $this->api->manyEstadoDeuda($user->conexiones()->get())
            ->reduce(function ($carry, $deuda) {
                return $carry + $deuda->monto;
            }, 0);

        if ($deudaTotal > 0) {
            Notificacion::create([
                'contenido' => 'Deudas pendientes: $ '. number_format($deudaTotal, 2, ',' , '.' ) . ' + intereses',
                'user_id' => $user->id
            ]);
        }

        return $deudaTotal;
    }
}
