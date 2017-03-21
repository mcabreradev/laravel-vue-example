<?php

namespace App\Models\OficinaVirtual;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expediente extends AppModel
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['numero'];

    /**
     * Relacion con usuarios
     * @return Collection
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\Admin\User');
    }
}
