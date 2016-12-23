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

    /**
     * Solicitudes
     */
    Route::group([
        'namespace' => 'Solicitudes',
        'as'        => 'solicitudes::',
        'prefix'    => 'solicitudes'
    ], function() {

        // Estados
        Route::get('estados', [
            'as'   => 'estados',
            'uses' => 'EstadosController@main'
        ]);
        Route::get('estados/create', [
            'as'   => 'estados.create',
            'uses' => 'EstadosController@create'
        ]);
        Route::get('estados/edit/{id}', [
            'as'   => 'estados.edit',
            'uses' => 'EstadosController@edit'
        ])->where('id', '[0-9]+');

        // Origenes
        Route::get('origenes', [
            'as'   => 'origenes',
            'uses' => 'OrigenesController@main'
        ]);
        Route::get('origenes/create', [
            'as'   => 'origenes.create',
            'uses' => 'OrigenesController@create'
        ]);
        Route::get('origenes/edit/{id}', [
            'as'   => 'origenes.edit',
            'uses' => 'OrigenesController@edit'
        ])->where('id', '[0-9]+');

        // Prioridades
        Route::get('prioridades', [
            'as'   => 'prioridades',
            'uses' => 'PrioridadesController@main'
        ]);
        Route::get('prioridades/create', [
            'as'   => 'prioridades.create',
            'uses' => 'PrioridadesController@create'
        ]);
        Route::get('prioridades/edit/{id}', [
            'as'   => 'prioridades.edit',
            'uses' => 'PrioridadesController@edit'
        ])->where('id', '[0-9]+');

        // Tipos
        Route::get('tipos', [
            'as'   => 'tipos',
            'uses' => 'TiposController@main'
        ]);
        Route::get('tipos/create', [
            'as'   => 'tipos.create',
            'uses' => 'TiposController@create'
        ]);
        Route::get('tipos/edit/{id}', [
            'as'   => 'tipos.edit',
            'uses' => 'TiposController@edit'
        ])->where('id', '[0-9]+');


        // Solicitantes
        Route::get('solicitantes', [
            'as'   => 'solicitantes',
            'uses' => 'SolicitantesController@main'
        ]);
        Route::get('solicitantes/create', [
            'as'   => 'solicitantes.create',
            'uses' => 'SolicitantesController@create'
        ]);
        Route::get('solicitantes/edit/{id}', [
            'as'   => 'solicitantes.edit',
            'uses' => 'SolicitantesController@edit'
        ])->where('id', '[0-9]+');

        Route::post('solicitantes', [
            'as'   => 'solicitantes.store',
            'uses' => 'SolicitantesController@store'
        ]);

        Route::put('solicitantes/{id}', [
            'as'   => 'solicitantes.update',
            'uses' => 'SolicitantesController@update'
        ])->where('id', '[0-9]+');

        // Solicitudes
        Route::get('solicitudes', [
            'as'   => 'solicitudes',
            'uses' => 'SolicitudesController@main'
        ]);
        Route::get('solicitudes/create', [
            'as'   => 'solicitudes.create',
            'uses' => 'SolicitudesController@create'
        ]);
        Route::get('solicitudes/edit/{id}', [
            'as'   => 'solicitudes.edit',
            'uses' => 'SolicitudesController@edit'
        ])->where('id', '[0-9]+');

        Route::post('solicitudes', [
            'as'   => 'solicitudes.store',
            'uses' => 'SolicitudesController@store'
        ]);

        Route::put('solicitudes/{id}', [
            'as'   => 'solicitudes.update',
            'uses' => 'SolicitudesController@update'
        ])->where('id', '[0-9]+');

    }); // Solicitudes group


});
