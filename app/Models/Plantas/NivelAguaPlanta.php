<?php

namespace App\Models\Plantas;

use App\Models\AppModel;

class NivelAguaPlanta extends AppModel
{
    public function nivelAguaPlantaRegistros()
    {
        return $this->hasMany('App\Models\Plantas\NivelAguaPlantaRegistro');
    }
}
