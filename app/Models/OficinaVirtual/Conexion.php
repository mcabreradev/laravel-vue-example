<?php

namespace App\Models\OficinaVirtual;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conexion extends AppModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conexiones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expediente',
        'unidad',
        'domicilio',
    ];

    /**
     * Incluye estos campos en la query
     *
     * @var [type]
     */
    protected $appends = ['domicilio_completo', 'tipo_busqueda'];

    /**
     * Obtiene el domicilio
     *
     * @return {string} El domicilio dependiendo las condiciones dadas
     */
    public function getDomicilioCompletoAttribute(){
        // inicializo
        $domicilio = '';

        $domicilio .= ($this->domicilio ?: '');

        // agrego expediente
        if (null !== $this->expediente) {
            $domicilio .= ($domicilio ? ' ' : '') . "- Expediente: {$this->expediente}";
        }

        // agrego unidad
        if (null !== $this->unidad) {
            $domicilio .= ($domicilio ? ' ' : '') . "- Unidad: {$this->unidad}";
        }

        return $domicilio;
    }

    /**
     *
     * @return void
     */
    public function getTipoBusquedaAttribute()
    {
        return '{"unidad":'.($this->unidad ?: 'null').', "expediente":'.($this->expediente ?: 'null').'}';
    }

    /**
     * Relacion con usuarios
     * @return Collection
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Admin\User', 'conexion_user');
    }
}
