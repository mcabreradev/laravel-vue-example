<?php

namespace App\Models\OficinaVirtual;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends AppModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'apellido', 'dni', 'telefono', 'email'];

    /**
     * Relacion con los pedidos hechos
     * @return Collection Los pedidos hechos por el usuario
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\OficinaVirtual\Pedido');
    }
}
