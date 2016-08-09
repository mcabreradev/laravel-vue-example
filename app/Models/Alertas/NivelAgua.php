<?php

namespace App\Models\Alertas;

use App\Models\AppModel;

class NivelAgua extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'niveles_agua';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'color', 'descripcion'];

    /**
     * [nivelAguaRegistros description]
     * @return [type] [description]
     */
    public function nivelAguaRegistros()
    {
        return $this->hasMany('App\Models\Alertas\NivelAguaRegistro');
    }
}
