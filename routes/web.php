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
    });

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
            'uses' => 'EstadosController@index'
        ]);

        Route::get('estados/list', [
            'as'   => 'estados.list',
            'uses' => 'EstadosController@main'
        ]);

        Route::get('estados/create', [
            'as'   => 'estados.create',
            'uses' => 'EstadosController@create'
        ]);

        Route::post('estados', [
            'as'   => 'estados.store',
            'uses' => 'EstadosController@store'
        ]);

        Route::get('estados/edit/{id}', [
            'as'   => 'estados.edit',
            'uses' => 'EstadosController@edit'
        ])->where('id', '[0-9]+');

        Route::put('estados/{id}', [
            'as'   => 'estados.update',
            'uses' => 'EstadosController@update'
        ])->where('id', '[0-9]+');

        Route::delete('estados/{id}', [
            'as'   => 'estados.destroy',
            'uses' => 'EstadosController@destroy'
        ])->where('id', '[0-9]+');

        // Origenes
        Route::get('origenes', [
            'as'   => 'origenes',
            'uses' => 'OrigenesController@index'
        ]);

        Route::get('origenes/list', [
            'as'   => 'origenes.list',
            'uses' => 'OrigenesController@main'
        ]);

        Route::get('origenes/create', [
            'as'   => 'origenes.create',
            'uses' => 'OrigenesController@create'
        ]);

        Route::post('origenes', [
            'as'   => 'origenes.store',
            'uses' => 'OrigenesController@store'
        ]);

        Route::get('origenes/edit/{id}', [
            'as'   => 'origenes.edit',
            'uses' => 'OrigenesController@edit'
        ])->where('id', '[0-9]+');

        Route::put('origenes/{id}', [
            'as'   => 'origenes.update',
            'uses' => 'OrigenesController@update'
        ])->where('id', '[0-9]+');

        Route::delete('origenes/{id}', [
            'as'   => 'origenes.destroy',
            'uses' => 'OrigenesController@destroy'
        ])->where('id', '[0-9]+');

        // Prioridades
        Route::get('prioridades', [
            'as'   => 'prioridades',
            'uses' => 'PrioridadesController@index'
        ]);

        Route::get('prioridades/list', [
            'as'   => 'prioridades.list',
            'uses' => 'PrioridadesController@main'
        ]);

        Route::get('prioridades/create', [
            'as'   => 'prioridades.create',
            'uses' => 'PrioridadesController@create'
        ]);

        Route::post('prioridades', [
            'as'   => 'prioridades.store',
            'uses' => 'PrioridadesController@store'
        ]);

        Route::get('prioridades/edit/{id}', [
            'as'   => 'prioridades.edit',
            'uses' => 'PrioridadesController@edit'
        ])->where('id', '[0-9]+');

        Route::put('prioridades/{id}', [
            'as'   => 'prioridades.update',
            'uses' => 'PrioridadesController@update'
        ])->where('id', '[0-9]+');

        Route::delete('prioridades/{id}', [
            'as'   => 'prioridades.destroy',
            'uses' => 'PrioridadesController@destroy'
        ])->where('id', '[0-9]+');

        // Tipos
        Route::get('tipos', [
            'as'   => 'tipos',
            'uses' => 'TiposController@index'
        ]);

        Route::get('tipos/list', [
            'as'   => 'tipos.list',
            'uses' => 'TiposController@main'
        ]);

        Route::get('tipos/create', [
            'as'   => 'tipos.create',
            'uses' => 'TiposController@create'
        ]);

        Route::post('tipos', [
            'as'   => 'tipos.store',
            'uses' => 'TiposController@store'
        ]);

        Route::get('tipos/edit/{id}', [
            'as'   => 'tipos.edit',
            'uses' => 'TiposController@edit'
        ])->where('id', '[0-9]+');

        Route::put('tipos/{id}', [
            'as'   => 'tipos.update',
            'uses' => 'TiposController@update'
        ])->where('id', '[0-9]+');

        Route::delete('tipos/{id}', [
            'as'   => 'tipos.destroy',
            'uses' => 'TiposController@destroy'
        ])->where('id', '[0-9]+');

        // Solicitudes

        Route::get('calles/{nombre}', [
            'as'   => 'calles.busqueda',
            'uses' => 'SolicitudesController@buscarCalles'
        ]);

        Route::get('solicitudes/', function(){
            return redirect()->route('solicitudes::solicitudes', ['estado' => '']);
        });

        Route::get('solicitudes/estado/{estado?}', [
            'as'   => 'solicitudes',
            'uses' => 'SolicitudesController@main'
        ])->where('id', '[a-z]+');

        Route::get('/', [
            'as'   => 'index',
            'uses' => 'SolicitudesController@index'
        ]);

        Route::get('solicitudes/create', [
            'as'   => 'solicitudes.create',
            'uses' => 'SolicitudesController@create'
        ]);

        Route::post('solicitudes', [
            'as'   => 'solicitudes.store',
            'uses' => 'SolicitudesController@store'
        ]);

        Route::get('solicitudes/{id}', [
            'as'   => 'show',
            'uses' => 'SolicitudesController@show'
        ])->where('id', '[0-9]+');

        Route::get('solicitudes/edit/{id}', [
            'as'   => 'solicitudes.edit',
            'uses' => 'SolicitudesController@edit'
        ])->where('id', '[0-9]+');

        Route::put('solicitudes/{id}', [
            'as'   => 'solicitudes.update',
            'uses' => 'SolicitudesController@update'
        ])->where('id', '[0-9]+');

        Route::delete('solicitudes/{id}', [
            'as'   => 'solicitudes.destroy',
            'uses' => 'SolicitudesController@destroy'
        ])->where('id', '[0-9]+');

        Route::get('solicitudes/{id}/timeline', [
            'as'   => 'solicitudes.timeline',
            'uses' => 'SolicitudesController@timeline'
        ])->where('id', '[0-9]+');

        Route::get('solicitudes/{id}/imprimir', [
            'as'   => 'solicitudes.imprimir',
            'uses' => 'SolicitudesController@imprimir'
        ])->where('id', '[0-9]+');

        Route::get('solicitudes/{id}/orden-trabajo', [
            'as'   => 'solicitudes.orden-trabajo',
            'uses' => 'SolicitudesController@imprimirOrdenTrabajo'
        ])->where('id', '[0-9]+');

        //   Areas
        Route::get('areas', [
            'as'   => 'areas',
            'uses' => 'AreasController@index'
        ]);

        Route::get('areas/list', [
            'as'   => 'areas.list',
            'uses' => 'AreasController@main'
        ]);

        Route::get('areas/create', [
            'as'   => 'areas.create',
            'uses' => 'AreasController@create'
        ]);

        Route::post('areas', [
            'as'   => 'areas.store',
            'uses' => 'AreasController@store'
        ]);

        Route::get('areas/edit/{id}', [
            'as'   => 'areas.edit',
            'uses' => 'AreasController@edit'
        ])->where('id', '[0-9]+');

        Route::put('areas/{id}', [
            'as'   => 'areas.update',
            'uses' => 'AreasController@update'
        ])->where('id', '[0-9]+');

        Route::delete('areas/{id}', [
            'as'   => 'areas.destroy',
            'uses' => 'AreasController@destroy'
        ])->where('id', '[0-9]+');

        /**
         * Agentes
         */
        Route::get('agentes', [
            'as'   => 'agentes',
            'uses' => 'AgentesController@index'
        ]);

        Route::get('agentes/list', [
            'as'   => 'agentes.list',
            'uses' => 'AgentesController@main'
        ]);

        Route::get('agentes/create', [
            'as'   => 'agentes.create',
            'uses' => 'AgentesController@create'
        ]);

        Route::post('agentes', [
            'as'   => 'agentes.store',
            'uses' => 'AgentesController@store'
        ]);

        Route::get('agentes/edit/{id}', [
            'as'   => 'agentes.edit',
            'uses' => 'AgentesController@edit'
        ])->where('id', '[0-9]+');

        Route::put('agentes/{id}', [
            'as'   => 'agentes.update',
            'uses' => 'AgentesController@update'
        ])->where('id', '[0-9]+');

        Route::delete('agentes/{id}', [
            'as'   => 'agentes.destroy',
            'uses' => 'AgentesController@destroy'
        ])->where('id', '[0-9]+');

        /**
         * Derivaciones
         */
        Route::post('derivaciones', [
            'as'   => 'derivaciones.store',
            'uses' => 'DerivacionesController@store'
        ]);

        Route::put('derivaciones/{id}', [
            'as'   => 'derivaciones.update',
            'uses' => 'DerivacionesController@update'
        ])->where('id', '[0-9]+');

        Route::delete('derivaciones/{id}', [
            'as'   => 'derivaciones.destroy',
            'uses' => 'DerivacionesController@destroy'
        ])->where('id', '[0-9]+');

        Route::get('derivaciones/{solicitudId}', [
            'as'   => 'derivaciones.por-solicitud',
            'uses' => 'DerivacionesController@porSolicitud'
        ])->where('solicitudId', '[0-9]+');

        /**
         * Seguimientos
         */
        Route::post('seguimientos', [
            'as'   => 'seguimientos.store',
            'uses' => 'SeguimientosController@store'
        ]);

        Route::put('seguimientos/{id}', [
            'as'   => 'seguimientos.update',
            'uses' => 'SeguimientosController@update'
        ])->where('id', '[0-9]+');

        Route::delete('seguimientos/{id}', [
            'as'   => 'seguimientos.destroy',
            'uses' => 'SeguimientosController@destroy'
        ])->where('id', '[0-9]+');

        Route::get('seguimientos/{solicitudId}', [
            'as'   => 'seguimientos.por-solicitud',
            'uses' => 'SeguimientosController@porSolicitud'
        ])->where('solicitudId', '[0-9]+');

    }); // Solicitudes group


});
