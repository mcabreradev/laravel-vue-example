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
        'as'         => 'permissions',
        'uses'       => 'PermissionController@index',
        'middleware' => ['permission:admin-permissions-browse'],
    ]);

    Route::get('permisos/list', [
        'as'         => 'permissions.list',
        'uses'       => 'PermissionController@main',
        'middleware' => ['permission:admin-permissions-browse'],
    ]);

    Route::post('permisos', [
        'as'   => 'permissions.store',
        'uses' => 'PermissionController@store',
        'middleware' => ['ability:admin,admin-permissions-add'],
    ]);

    Route::put('permisos/{id}', [
        'as'   => 'permissions.update',
        'uses' => 'PermissionController@update',
        'middleware' => ['ability:admin,admin-permissions-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('permisos/{id}', [
        'as'   => 'permissions.destroy',
        'uses' => 'PermissionController@destroy',
        'middleware' => ['ability:admin,admin-permissions-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Roles
     */
    Route::get('roles', [
        'as'   => 'roles',
        'uses' => 'RoleController@index',
        'middleware' => ['ability:admin,admin-roles-browse'],
    ]);

    Route::get('roles/list', [
        'as'   => 'roles.list',
        'uses' => 'RoleController@main',
        'middleware' => ['ability:admin,admin-roles-browse'],
    ]);

    Route::get('roles/create', [
        'as'   => 'roles.create',
        'uses' => 'RoleController@create',
        'middleware' => ['ability:admin,admin-roles-add'],
    ]);

    Route::post('roles', [
        'as'   => 'roles.store',
        'uses' => 'RoleController@store',
        'middleware' => ['ability:admin,admin-roles-add'],
    ]);

    Route::get('roles/edit/{id}', [
        'as'   => 'roles.edit',
        'uses' => 'RoleController@edit',
        'middleware' => ['ability:admin,admin-roles-edit'],
    ])->where('id', '[0-9]+');

    Route::put('roles/{id}', [
        'as'   => 'roles.update',
        'uses' => 'RoleController@update',
        'middleware' => ['ability:admin,admin-roles-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('roles/{id}', [
        'as'   => 'roles.destroy',
        'uses' => 'RoleController@destroy',
        'middleware' => ['ability:admin,admin-roles-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Users
     */
    Route::get('users', [
        'as'   => 'users',
        'uses' => 'UserController@index',
        'middleware' => ['ability:admin,admin-users-browse'],
    ]);

    Route::get('users/list', [
        'as'   => 'users.list',
        'uses' => 'UserController@main',
        'middleware' => ['ability:admin,admin-users-browse'],
    ]);

    Route::get('users/create', [
        'as'   => 'users.create',
        'uses' => 'UserController@create',
        'middleware' => ['ability:admin,admin-users-add'],
    ]);

    Route::post('users', [
        'as'   => 'users.store',
        'uses' => 'UserController@store',
        'middleware' => ['ability:admin,admin-users-add'],
    ]);

    Route::get('users/edit/{id}', [
        'as'   => 'users.edit',
        'uses' => 'UserController@edit',
        'middleware' => ['ability:admin,admin-users-edit'],
    ])->where('id', '[0-9]+');

    Route::put('users/{id}', [
        'as'   => 'users.update',
        'uses' => 'UserController@update',
        'middleware' => ['ability:admin,admin-users-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('users/{id}', [
        'as'   => 'users.destroy',
        'uses' => 'UserController@destroy',
        'middleware' => ['ability:admin,admin-users-delete'],
    ])->where('id', '[0-9]+');

    Route::get('users/send-reset-password', [
        'as'   => 'users.send-reset-password',
        'uses' => 'UserController@sendResetLinkEmail',
        'middleware' => ['ability:admin,admin-users-send-reset'],
    ]);

    Route::get('users/{user}/send-verification-email', [
        'as'   => 'users.send-verification-email',
        'uses' => 'UserController@sendVerificationEmail',
        'middleware' => ['ability:admin,admin-users-send-verification'],
    ]);
});
