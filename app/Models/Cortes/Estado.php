<?php

namespace App\Models\Cortes;

use App\Models\AppModel;

class Estado extends AppModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['titulo', 'color'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cortes_estados';

    /**
     * [barriosSituaciones description]
     * @return [type] [description]
     */
    public function barriosSituaciones()
    {
        return $this->hasMany('App\Models\Cortes\BarrioSituacion');
    }
}
