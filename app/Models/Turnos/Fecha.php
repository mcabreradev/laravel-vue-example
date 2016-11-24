<?php

namespace App\Models\Turnos;

use App\Models\AppModel;

class Fecha extends AppModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'turnos';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fechas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['fecha'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha'];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d';

    /**
     * @return [type] [description]
     */
    public function actividad()
    {
        return $this->belongsTo('App\Models\Turnos\Actividad');
    }
}
