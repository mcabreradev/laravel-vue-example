<?php

namespace App\Models\Alertas;

use App\Models\AppModel;

class Alerta extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'alertas';

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

    /**
     * [barriosSituaciones description]
     * @return [type] [description]
     */
    public function detalles()
    {
        return $this->hasMany('App\Models\Alertas\AlertaDetalle');
    }
}
