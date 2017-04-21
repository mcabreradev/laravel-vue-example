<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait, SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'pgsql';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'verified', 'telefono'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'verification_token'];

    /**
     * Relacion con las conexiones
     * @return Collection
     */
    public function conexiones()
    {
        return $this->belongsToMany('App\Models\OficinaVirtual\Conexion', 'conexion_user');
    }

    /**
     * Relacion con las notifiaciones
     * @return Collection
     */
    public function notificaciones()
    {
        return $this->hasMany('App\Models\OficinaVirtual\Notificacion');
    }
}
