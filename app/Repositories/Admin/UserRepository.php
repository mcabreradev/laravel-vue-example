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
    public function getEstadoCuenta(User $user)
    {
        $api = $this->api;
        $estadoCuenta = (object) [
            'impagasCant'   => 0,
            'impagasMonto'  => 0,
            'historicoCant' => 0,
        ];

        $api->getManyUltimasBoletas($user->conexiones()->get())
            ->each(function($boleta) use (&$estadoCuenta, $api) {
                $estadoCuenta->historicoCant++;

                if ($api->boletaIsImpaga($boleta)) {
                    $estadoCuenta->impagasCant++;
                    $estadoCuenta->impagasMonto += $api->getBoletaMontoActual($boleta);
                }
            });

        return $estadoCuenta;
    }

    /**
     * [getAllBoletasImpagas description]
     * @return [type] [description]
     */
    public function getAllBoletasImpagas(User $user)
    {
        return $this->api->getManyUltimasBoletasImpagas($user->conexiones()->get());
    }
}
