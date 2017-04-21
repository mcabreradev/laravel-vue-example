<?php

namespace App\Models\Admin;

use Laratrust\LaratrustPermission;

class Permission extends LaratrustPermission
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
    protected $fillable = ['name', 'display_name', 'description'];
}
