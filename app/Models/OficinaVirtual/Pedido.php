<?php

namespace App\Models\OficinaVirtual;

use App\Models\AppModel;

class Pedido extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estado',
        'descripcion',
        'observaciones',
        'tipo',
        'domicilio',
        'unidad',
        'macizo',
        'parcela'
    ];

    /**
     * Relacion con el usuario que genero el pedido
     * @return App\Models\OficinaVirtual\Usuario Usuario que genero el pedido
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\OficinaVirtual\Usuario');
    }

    /**
     * Relacion con sus adjuntos
     * @return Collection Adjuntos del pedido
     */
    public function adjuntos()
    {
        return $this->hasMany('App\Models\OficinaVirtual\Adjunto');
    }
}
