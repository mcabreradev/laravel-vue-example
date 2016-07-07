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
    protected $fillable = [
        'nombre', 'apellido', 'documento'
    ];

    /**
     * Relacion con los pedidos hechos
     * @return Collection Los pedidos hechos por el usuario
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\OficinaVirtual\Pedido');
    }

    /**
     * Devuelve el nombre completo de un usuario
     * @return string Nombre completo
     */
    public function getNombreCompleto()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}
