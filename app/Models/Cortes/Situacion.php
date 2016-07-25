<?php

namespace App\Models\Cortes;

use App\Models\AppModel;

class Situacion extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cortes_situaciones';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'inicia_el', 'finaliza_el'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['inicia_el', 'finaliza_el', 'descripcion'];

    public function barriosSituaciones()
    {
        return $this->hasMany('App\Models\Cortes\BarrioSituacion', 'cortes_situacion_id');
    }
}
