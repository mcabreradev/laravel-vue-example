<?php

namespace App\Models\Admin;

use Laratrust\LaratrustRole;

class Role extends LaratrustRole
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];
}
