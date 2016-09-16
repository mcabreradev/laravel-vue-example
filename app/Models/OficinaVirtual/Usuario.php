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
        'nombre', 'apellido', 'documento', 'email', 'movil', 'validado'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'nombre', 'apellido', 'documento', 'email', 'movil'];

    /**
     * Relacion con los pedidos hechos
     * @return Collection Los pedidos hechos por el usuario
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\OficinaVirtual\Pedido');
    }

    /**
     * Relacion con los turnos solicitados
     * @return Collection Los turnos solicitados por el usuario
     */
    public function turnos()
    {
        return $this->hasMany('App\Models\Turnos\Turno');
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
