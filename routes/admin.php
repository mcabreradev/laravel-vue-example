<?php
/**
 * ADMIN
 */
Route::group([
    'namespace' => 'Admin',
    'as'        => 'admin::',
    'prefix'    => 'admin'
], function() {

    /**
     * Permisos
     */
    Route::get('permisos', [
        'as'   => 'permissions',
        'uses' => 'PermissionController@index'
    ]);

    Route::get('permisos/list', [
        'as'   => 'permissions.list',
        'uses' => 'PermissionController@main'
    ]);

    Route::post('permisos', [
        'as'   => 'permissions.store',
        'uses' => 'PermissionController@store'
    ]);

    Route::put('permisos/{id}', [
        'as'   => 'permissions.update',
        'uses' => 'PermissionController@update'
    ])->where('id', '[0-9]+');

    Route::delete('permisos/{id}', [
        'as'   => 'permissions.destroy',
        'uses' => 'PermissionController@destroy'
    ])->where('id', '[0-9]+');

    /**
     * Roles
     */
    Route::get('roles', [
        'as'   => 'roles',
        'uses' => 'RoleController@index'
    ]);

    Route::get('roles/list', [
        'as'   => 'roles.list',
        'uses' => 'RoleController@main'
    ]);

    Route::get('roles/create', [
        'as'   => 'roles.create',
        'uses' => 'RoleController@create'
    ]);

    Route::post('roles', [
        'as'   => 'roles.store',
        'uses' => 'RoleController@store'
    ]);

    Route::get('roles/edit/{id}', [
        'as'   => 'roles.edit',
        'uses' => 'RoleController@edit'
    ])->where('id', '[0-9]+');

    Route::put('roles/{id}', [
        'as'   => 'roles.update',
        'uses' => 'RoleController@update'
    ])->where('id', '[0-9]+');

    Route::delete('roles/{id}', [
        'as'   => 'roles.destroy',
        'uses' => 'RoleController@destroy'
    ])->where('id', '[0-9]+');

    /**
     * Users
     */
    Route::get('users', [
        'as'   => 'users',
        'uses' => 'UserController@index'
    ]);

    Route::get('users/list', [
        'as'   => 'users.list',
        'uses' => 'UserController@main'
    ]);

    Route::get('users/create', [
        'as'   => 'users.create',
        'uses' => 'UserController@create'
    ]);

    Route::post('users', [
        'as'   => 'users.store',
        'uses' => 'UserController@store'
    ]);

    Route::get('users/edit/{id}', [
        'as'   => 'users.edit',
        'uses' => 'UserController@edit'
    ])->where('id', '[0-9]+');

    Route::put('users/{id}', [
        'as'   => 'users.update',
        'uses' => 'UserController@update'
    ])->where('id', '[0-9]+');

    Route::delete('users/{id}', [
        'as'   => 'users.destroy',
        'uses' => 'UserController@destroy'
    ])->where('id', '[0-9]+');

    Route::get('users/send-reset-password', [
        'as'   => 'users.send-reset-password',
        'uses' => 'UserController@sendResetLinkEmail'
    ]);

    Route::get('users/{user}/send-verification-email', [
        'as'   => 'users.send-verification-email',
        'uses' => 'UserController@sendVerificationEmail'
    ]);
});
