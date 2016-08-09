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
     * [nivelAguaPlanta description]
     * @return [type] [description]
     */
    public function nivelAgua()
    {
        return $this->belongsTo('App\Models\Alertas\NivelAgua');
    }
}
