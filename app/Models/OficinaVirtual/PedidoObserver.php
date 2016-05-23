<?php

namespace App\Models\OficinaVirtual;

class PedidoObserver
{
    public function creating($model)
    {
        if ($model->estado == null) {
            $model->estado = 'pediente';
        }
    }
}
