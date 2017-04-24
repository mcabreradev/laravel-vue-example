<?php

/**
 * Solicitudes
 */
Route::group([
    'namespace' => 'Solicitudes',
    'as'        => 'solicitudes::',
    'prefix'    => 'solicitudes'
], function() {

    /**
     * Estados
     */
    Route::get('estados', [
        'as'   => 'estados',
        'uses' => 'EstadosController@index',
        'middleware' => ['ability:admin,solicitudes-estados-browse'],
    ]);

    Route::get('estados/list', [
        'as'   => 'estados.list',
        'uses' => 'EstadosController@main',
        'middleware' => ['ability:admin,solicitudes-estados-browse'],
    ]);

    Route::get('estados/create', [
        'as'   => 'estados.create',
        'uses' => 'EstadosController@create',
        'middleware' => ['ability:admin,solicitudes-estados-add'],
    ]);

    Route::post('estados', [
        'as'   => 'estados.store',
        'uses' => 'EstadosController@store',
        'middleware' => ['ability:admin,solicitudes-estados-add'],
    ]);

    Route::get('estados/edit/{id}', [
        'as'   => 'estados.edit',
        'uses' => 'EstadosController@edit',
        'middleware' => ['ability:admin,solicitudes-estados-edit'],
    ])->where('id', '[0-9]+');

    Route::put('estados/{id}', [
        'as'   => 'estados.update',
        'uses' => 'EstadosController@update',
        'middleware' => ['ability:admin,solicitudes-estados-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('estados/{id}', [
        'as'   => 'estados.destroy',
        'uses' => 'EstadosController@destroy',
        'middleware' => ['ability:admin,solicitudes-estados-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Origenes
     */
    Route::get('origenes', [
        'as'   => 'origenes',
        'uses' => 'OrigenesController@index',
        'middleware' => ['ability:admin,solicitudes-origenes-browse'],
    ]);

    Route::get('origenes/list', [
        'as'   => 'origenes.list',
        'uses' => 'OrigenesController@main',
        'middleware' => ['ability:admin,solicitudes-origenes-browse'],
    ]);

    Route::get('origenes/create', [
        'as'   => 'origenes.create',
        'uses' => 'OrigenesController@create',
        'middleware' => ['ability:admin,solicitudes-origenes-add'],
    ]);

    Route::post('origenes', [
        'as'   => 'origenes.store',
        'uses' => 'OrigenesController@store',
        'middleware' => ['ability:admin,solicitudes-origenes-add'],
    ]);

    Route::get('origenes/edit/{id}', [
        'as'   => 'origenes.edit',
        'uses' => 'OrigenesController@edit',
        'middleware' => ['ability:admin,solicitudes-origenes-edit'],
    ])->where('id', '[0-9]+');

    Route::put('origenes/{id}', [
        'as'   => 'origenes.update',
        'uses' => 'OrigenesController@update',
        'middleware' => ['ability:admin,solicitudes-origenes-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('origenes/{id}', [
        'as'   => 'origenes.destroy',
        'uses' => 'OrigenesController@destroy',
        'middleware' => ['ability:admin,solicitudes-origenes-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Prioridades
     */
    Route::get('prioridades', [
        'as'   => 'prioridades',
        'uses' => 'PrioridadesController@index',
        'middleware' => ['ability:admin,solicitudes-prioridades-browse'],
    ]);

    Route::get('prioridades/list', [
        'as'   => 'prioridades.list',
        'uses' => 'PrioridadesController@main',
        'middleware' => ['ability:admin,solicitudes-prioridades-browse'],
    ]);

    Route::get('prioridades/create', [
        'as'   => 'prioridades.create',
        'uses' => 'PrioridadesController@create',
        'middleware' => ['ability:admin,solicitudes-prioridades-add'],
    ]);

    Route::post('prioridades', [
        'as'   => 'prioridades.store',
        'uses' => 'PrioridadesController@store',
        'middleware' => ['ability:admin,solicitudes-prioridades-add'],
    ]);

    Route::get('prioridades/edit/{id}', [
        'as'   => 'prioridades.edit',
        'uses' => 'PrioridadesController@edit',
        'middleware' => ['ability:admin,solicitudes-prioridades-edit'],
    ])->where('id', '[0-9]+');

    Route::put('prioridades/{id}', [
        'as'   => 'prioridades.update',
        'uses' => 'PrioridadesController@update',
        'middleware' => ['ability:admin,solicitudes-prioridades-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('prioridades/{id}', [
        'as'   => 'prioridades.destroy',
        'uses' => 'PrioridadesController@destroy',
        'middleware' => ['ability:admin,solicitudes-prioridades-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Tipos
     */
    Route::get('tipos', [
        'as'   => 'tipos',
        'uses' => 'TiposController@index',
        'middleware' => ['ability:admin,solicitudes-tipos-browse'],
    ]);

    Route::get('tipos/list', [
        'as'   => 'tipos.list',
        'uses' => 'TiposController@main',
        'middleware' => ['ability:admin,solicitudes-tipos-browse'],
    ]);

    Route::get('tipos/create', [
        'as'   => 'tipos.create',
        'uses' => 'TiposController@create',
        'middleware' => ['ability:admin,solicitudes-tipos-add'],
    ]);

    Route::post('tipos', [
        'as'   => 'tipos.store',
        'uses' => 'TiposController@store',
        'middleware' => ['ability:admin,solicitudes-tipos-add'],
    ]);

    Route::get('tipos/edit/{id}', [
        'as'   => 'tipos.edit',
        'uses' => 'TiposController@edit',
        'middleware' => ['ability:admin,solicitudes-tipos-edit'],
    ])->where('id', '[0-9]+');

    Route::put('tipos/{id}', [
        'as'   => 'tipos.update',
        'uses' => 'TiposController@update',
        'middleware' => ['ability:admin,solicitudes-tipos-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('tipos/{id}', [
        'as'   => 'tipos.destroy',
        'uses' => 'TiposController@destroy',
        'middleware' => ['ability:admin,solicitudes-tipos-browse'],
    ])->where('id', '[0-9]+');

    /**
     * Solicitudes
     */
    Route::get('calles/{nombre}', [
        'as'   => 'calles.busqueda',
        'uses' => 'SolicitudesController@buscarCalles',
        'middleware' => ['ability:admin,solicitudes-add|solicitudes-edit'],
    ]);

    Route::get('solicitudes/', [
        'middleware' => ['ability:admin,solicitudes-browse'],
        function(){
            return redirect()->route('solicitudes::solicitudes', ['estado' => '']);
        }
    ]);

    Route::get('solicitudes/estado/{estado?}', [
        'as'   => 'solicitudes',
        'uses' => 'SolicitudesController@main',
        'middleware' => ['ability:admin,solicitudes-browse'],
    ])->where('id', '[a-z]+');

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'SolicitudesController@index',
        'middleware' => ['ability:admin,solicitudes-browse'],
    ]);

    Route::get('solicitudes/create', [
        'as'   => 'solicitudes.create',
        'uses' => 'SolicitudesController@create',
        'middleware' => ['ability:admin,solicitudes-add'],
    ]);

    Route::post('solicitudes', [
        'as'   => 'solicitudes.store',
        'uses' => 'SolicitudesController@store',
        'middleware' => ['ability:admin,solicitudes-add'],
    ]);

    Route::get('solicitudes/{id}', [
        'as'   => 'show',
        'uses' => 'SolicitudesController@show',
        'middleware' => ['ability:admin,solicitudes-browse'],
    ])->where('id', '[0-9]+');

    Route::get('solicitudes/edit/{id}', [
        'as'   => 'solicitudes.edit',
        'uses' => 'SolicitudesController@edit',
        'middleware' => ['ability:admin,solicitudes-edit'],
    ])->where('id', '[0-9]+');

    Route::put('solicitudes/{id}', [
        'as'   => 'solicitudes.update',
        'uses' => 'SolicitudesController@update',
        'middleware' => ['ability:admin,solicitudes-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('solicitudes/{id}', [
        'as'   => 'solicitudes.destroy',
        'uses' => 'SolicitudesController@destroy',
        'middleware' => ['ability:admin,solicitudes-delete'],
    ])->where('id', '[0-9]+');

    Route::get('solicitudes/{id}/timeline', [
        'as'   => 'solicitudes.timeline',
        'uses' => 'SolicitudesController@timeline',
        'middleware' => ['ability:admin,solicitudes-timeline'],
    ])->where('id', '[0-9]+');

    Route::get('solicitudes/{id}/imprimir', [
        'as'   => 'solicitudes.imprimir',
        'uses' => 'SolicitudesController@imprimir',
        'middleware' => ['ability:admin,solicitudes-imprimir'],
    ])->where('id', '[0-9]+');

    Route::get('solicitudes/{id}/orden-trabajo', [
        'as'   => 'solicitudes.orden-trabajo',
        'uses' => 'SolicitudesController@imprimirOrdenTrabajo',
        'middleware' => ['ability:admin,solicitudes-imprimir-orden-trabajo'],
    ])->where('id', '[0-9]+');

    /**
     * Areas
     */
    Route::get('areas', [
        'as'   => 'areas',
        'uses' => 'AreasController@index',
        'middleware' => ['ability:admin,solicitudes-areas-browse'],
    ]);

    Route::get('areas/list', [
        'as'   => 'areas.list',
        'uses' => 'AreasController@main',
        'middleware' => ['ability:admin,solicitudes-areas-browse'],
    ]);

    Route::get('areas/create', [
        'as'   => 'areas.create',
        'uses' => 'AreasController@create',
        'middleware' => ['ability:admin,solicitudes-areas-add'],
    ]);

    Route::post('areas', [
        'as'   => 'areas.store',
        'uses' => 'AreasController@store',
        'middleware' => ['ability:admin,solicitudes-areas-add'],
    ]);

    Route::get('areas/edit/{id}', [
        'as'   => 'areas.edit',
        'uses' => 'AreasController@edit',
        'middleware' => ['ability:admin,solicitudes-areas-edit'],
    ])->where('id', '[0-9]+');

    Route::put('areas/{id}', [
        'as'   => 'areas.update',
        'uses' => 'AreasController@update',
        'middleware' => ['ability:admin,solicitudes-areas-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('areas/{id}', [
        'as'   => 'areas.destroy',
        'uses' => 'AreasController@destroy',
        'middleware' => ['ability:admin,solicitudes-areas-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Agentes
     */
    Route::get('agentes', [
        'as'   => 'agentes',
        'uses' => 'AgentesController@index',
        'middleware' => ['ability:admin,solicitudes-agentes-browse'],
    ]);

    Route::get('agentes/list', [
        'as'   => 'agentes.list',
        'uses' => 'AgentesController@main',
        'middleware' => ['ability:admin,solicitudes-agentes-browse'],
    ]);

    Route::get('agentes/create', [
        'as'   => 'agentes.create',
        'uses' => 'AgentesController@create',
        'middleware' => ['ability:admin,solicitudes-agentes-add'],
    ]);

    Route::post('agentes', [
        'as'   => 'agentes.store',
        'uses' => 'AgentesController@store',
        'middleware' => ['ability:admin,solicitudes-agentes-add'],
    ]);

    Route::get('agentes/edit/{id}', [
        'as'   => 'agentes.edit',
        'uses' => 'AgentesController@edit',
        'middleware' => ['ability:admin,solicitudes-agentes-edit'],
    ])->where('id', '[0-9]+');

    Route::put('agentes/{id}', [
        'as'   => 'agentes.update',
        'uses' => 'AgentesController@update',
        'middleware' => ['ability:admin,solicitudes-agentes-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('agentes/{id}', [
        'as'   => 'agentes.destroy',
        'uses' => 'AgentesController@destroy',
        'middleware' => ['ability:admin,solicitudes-agentes-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Derivaciones
     */
    Route::post('derivaciones', [
        'as'   => 'derivaciones.store',
        'uses' => 'DerivacionesController@store',
        'middleware' => ['ability:admin,solicitudes-derivaciones-add'],
    ]);

    Route::put('derivaciones/{id}', [
        'as'   => 'derivaciones.update',
        'uses' => 'DerivacionesController@update',
        'middleware' => ['ability:admin,solicitudes-derivaciones-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('derivaciones/{id}', [
        'as'   => 'derivaciones.destroy',
        'uses' => 'DerivacionesController@destroy',
        'middleware' => ['ability:admin,solicitudes-derivaciones-delete'],
    ])->where('id', '[0-9]+');

    Route::get('derivaciones/{solicitudId}', [
        'as'   => 'derivaciones.por-solicitud',
        'uses' => 'DerivacionesController@porSolicitud',
        'middleware' => ['ability:admin,solicitudes-browse'],
    ])->where('solicitudId', '[0-9]+');

    /**
     * Seguimientos
     */
    Route::post('seguimientos', [
        'as'   => 'seguimientos.store',
        'uses' => 'SeguimientosController@store',
        'middleware' => ['ability:admin,solicitudes-seguimientos-add'],
    ]);

    Route::put('seguimientos/{id}', [
        'as'   => 'seguimientos.update',
        'uses' => 'SeguimientosController@update',
        'middleware' => ['ability:admin,solicitudes-seguimientos-edit'],
    ])->where('id', '[0-9]+');

    Route::delete('seguimientos/{id}', [
        'as'   => 'seguimientos.destroy',
        'uses' => 'SeguimientosController@destroy',
        'middleware' => ['ability:admin,solicitudes-seguimientos-delete'],
    ])->where('id', '[0-9]+');

    Route::get('seguimientos/{solicitudId}', [
        'as'   => 'seguimientos.por-solicitud',
        'uses' => 'SeguimientosController@porSolicitud',
        'middleware' => ['ability:admin,solicitudes-browse'],
    ])->where('solicitudId', '[0-9]+');

}); // Solicitudes group
