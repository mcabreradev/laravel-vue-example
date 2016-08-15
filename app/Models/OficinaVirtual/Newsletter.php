<?php

namespace app\Models\OficinaVirtual;

use App\Models\AppModel;

class Newsletter extends AppModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'newsletter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'apellido', 'email'];
}
