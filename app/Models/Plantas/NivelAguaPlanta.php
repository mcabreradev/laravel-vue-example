<?php

namespace App\Models\Plantas;

use App\Models\AppModel;

class NivelAguaPlanta extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'etiqueta', 'descripcion'];

    /**
     * [nivelAguaPlantaRegistros description]
     * @return [type] [description]
     */
    public function nivelAguaPlantaRegistros()
    {
        return $this->hasMany('App\Models\Plantas\NivelAguaPlantaRegistro');
    }
}
