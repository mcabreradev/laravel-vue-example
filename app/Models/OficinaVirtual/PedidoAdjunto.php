<?php

namespace app\Models\OficinaVirtual;

use App\Models\AppModel;

class PedidoAdjunto extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo'];

    /**
     * Relacion con su pedido
     * @return App\Models\OficinaVirtual\Pedido El pedido al que esta asociado
     */
    public function pedido()
    {
        return $this->belongsTo('App\Models\OficinaVirtual\Pedido');
    }
}
