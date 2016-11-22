<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * Auth
 */
Route::group(['as' => 'auth::'], function() {

    Route::get('/login', [
        'as'   => 'login.form',
        'uses' => 'Auth\AuthController@showLoginForm'
    ]);

    Route::post('/login', [
        'as'   => 'login',
        'uses' => 'Auth\AuthController@login'
    ]);

    Route::get('/logout', [
        'as'   => 'logout',
        'uses' => 'Auth\AuthController@logout'
    ]);
});


/**
 * User authenticated routes
 */
Route::group(['middleware' => ['auth']], function() {

	/**
     * HOME
     */
    Route::get('/', [
    	'as' => 'home',
    	'uses' => 'HomeController@index'
    ]);

	/**
     * Users
     */
    Route::get('/users/profile', [
        'as'   => 'users.profile.form',
        'uses' => 'Admin\UserController@profile'
    ]);

    Route::put('/users/profile', [
        'as'   => 'users.profile',
        'uses' => 'Admin\UserController@saveProfile'
    ]);

    /**
     * Pedidos
     */
    Route::get('/pedidos/create', [
        'as'   => 'pedidos.create',
        'uses' => 'OficinaVirtual\PedidoController@create'
    ]);

    Route::get('/pedidos/edit/{id}', [
        'as'   => 'pedidos.edit',
        'uses' => 'OficinaVirtual\PedidoController@edit'
    ])->where('id', '[0-9]+');

    Route::put('/pedidos/{id}', [
        'as'   => 'pedidos.update',
        'uses' => 'OficinaVirtual\PedidoController@update'
    ])->where('id', '[0-9]+');

    Route::delete('/pedidos/{id}', [
        'as'   => 'pedidos.destroy',
        'uses' => 'OficinaVirtual\PedidoController@destroy'
    ])->where('id', '[0-9]+');

    Route::delete('/pedidos/{id}/enviar-email', [
        'as'   => 'pedidos.enviar.email',
        'uses' => 'OficinaVirtual\PedidoController@enviarEmail'
    ])->where('id', '[0-9]+');

    Route::post('/pedidos', [
        'as'   => 'pedidos.store',
        'uses' => 'OficinaVirtual\PedidoController@store'
    ]);

    Route::get('/pedidos/{estado?}', [
        'as'   => 'pedidos.index',
        'uses' => 'OficinaVirtual\PedidoController@index'
    ])->where('id', '[a-z]+');

    /**
     * Pedido Adjuntos
     */
    Route::post('/pedidos-adjuntos', [
        'as'   => 'pedidos.adjuntos.store',
        'uses' => 'OficinaVirtual\PedidoAdjuntoController@store'
    ]);

    Route::delete('/pedidos-adjuntos/{id}', [
        'as'   => 'pedidos.adjuntos.destroy',
        'uses' => 'OficinaVirtual\PedidoAdjuntoController@destroy'
    ])->where('id', '[0-9]+');

    /**
     * Alertas
     */
    Route::group([
        'namespace' => 'Alertas',
        'as'        => 'alertas::',
        'prefix'    => 'alertas'
    ], function() {

        /**
         * Nivel Agua
         */

        Route::get('niveles-agua', [
            'as'   => 'niveles-agua.index',
            'uses' => 'NivelAguaController@index'
        ]);

        Route::post('niveles-agua', [
            'as'   => 'niveles-agua.store',
            'uses' => 'NivelAguaController@store'
        ]);

        Route::delete('niveles-agua/{id}', [
            'as'   => 'niveles-agua.destroy',
            'uses' => 'NivelAguaController@destroy'
        ])->where('id', '[0-9]+');

        /**
         * Registro de nivel de agua en plantas
         */

        Route::get('/registros-nivel-agua', [
            'as'   => 'registros-nivel-agua.index',
            'uses' => 'NivelAguaRegistroController@index'
        ]);

        Route::post('/registros-nivel-agua', [
            'as'   => 'registros-nivel-agua.store',
            'uses' => 'NivelAguaRegistroController@store'
        ]);

        Route::delete('/registros-nivel-agua/{id}', [
            'as'   => 'registros-nivel-agua.destroy',
            'uses' => 'NivelAguaRegistroController@destroy'
        ])->where('id', '[0-9]+');

        /**
         * Alerta mapa
         */

        Route::get('/', [
            'as'   => 'index',
            'uses' => 'AlertaController@index'
        ]);

        Route::get('/create', [
            'as'   => 'create',
            'uses' => 'AlertaController@create'
        ]);

        Route::get('/create/layer', [
            'as'   => 'create.layer',
            'uses' => 'AlertaController@createLayer'
        ]);

        Route::post('/', [
            'as'   => 'store',
            'uses' => 'AlertaController@store'
        ]);

        Route::get('/edit/{id}', [
            'as'   => 'edit',
            'uses' => 'AlertaController@edit'
        ]);

        Route::get('/edit/{id}/layer', [
            'as'   => 'edit.layer',
            'uses' => 'AlertaController@editLayer'
        ]);

        Route::delete('/{id}', [
            'as'   => 'destroy',
            'uses' => 'AlertaController@destroy'
        ])->where('id', '[0-9]+');

        /**
         * Aleta mapa Estados
         */

        Route::get('estados', [
            'as'   => 'estados.index',
            'uses' => 'EstadoController@index'
        ]);

        Route::post('estados', [
            'as'   => 'estados.store',
            'uses' => 'EstadoController@store'
        ]);

        Route::delete('estados/{id}', [
            'as'   => 'estados.destroy',
            'uses' => 'EstadoController@destroy'
        ])->where('id', '[0-9]+');
    }); // alertas group

    /**
     * Turnos
     */
    Route::group([
        'namespace' => 'Turnos',
        'as'        => 'turnos::',
        'prefix'    => 'turnos'
    ], function() {

        Route::get('/', [
            'as'   => 'index',
            'uses' => 'TurnoController@index'
        ]);

        Route::get('asignados/{actividadId}', [
            'as'   => 'asignados-por-actividad',
            'uses' => 'TurnoController@asignadosPorActividad'
        ])->where('actividadId', '[0-9]+');

        Route::get('vencidos/{actividadId}', [
            'as'   => 'vencidos-por-actividad',
            'uses' => 'TurnoController@vencidosPorActividad'
        ])->where('actividadId', '[0-9]+');

        Route::put('validar-atencion/{id}', [
            'as'   => 'validar-atencion',
            'uses' => 'TurnoController@validarAtencion'
        ])->where('id', '[0-9]+');

        Route::delete('/{id}', [
            'as'   => 'destroy',
            'uses' => 'TurnoController@destroy'
        ])->where('id', '[0-9]+');

    }); // turnos group


});
