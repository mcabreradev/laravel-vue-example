<?php

namespace App\Models\Plantas;

use App\Models\AppModel;

class NivelAguaPlantaRegistro extends AppModel
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
    public function nivelAguaPlanta()
    {
        return $this->belongsTo('App\Models\Plantas\NivelAguaPlanta');
    }
}
