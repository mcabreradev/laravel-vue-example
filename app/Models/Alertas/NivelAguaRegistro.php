<?php

namespace App\Models\Alertas;

use App\Models\AppModel;

class NivelAguaRegistro extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['registrado_el'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['registrado_el'];

    /**
     * [nivelAguaPlanta description]
     * @return [type] [description]
     */
    public function nivelAgua()
    {
        return $this->belongsTo('App\Models\Alertas\NivelAgua');
    }
}
