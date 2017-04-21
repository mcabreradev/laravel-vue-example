<?php

namespace App\Models\OficinaVirtual;

use App\Models\AppModel;

class Notificacion extends AppModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notificaciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contenido', 'user_id'];

    /**
     * Relacion con usuarios
     * @return Collection
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Admin\User');
    }
}
