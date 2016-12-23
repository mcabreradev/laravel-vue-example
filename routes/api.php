<?php

/**
* HOME
*/
// catch all options requests
Route::options('{all}', function(){})->where('all', '.*');

Route::group([
    'prefix' => 'v1',
    'as'     => 'api::v1::'
], function()
{
    Route::post('newsletter/registrarse', function() {
        try {
            App\Models\OficinaVirtual\Newsletter::create(request()->input());
            return response(null, 201);
        } catch (\Exception $e) {
            return response('Error al suscribirse', 500);
        }
    });

    /**
        * Alertas
        */

    Route::get('alertas/nivel-agua', [
        'uses' => 'Alertas\NivelAguaRegistroController@nivelAguaActual',
        'as'   => 'alertas::nivel.agua'
    ]);

    Route::get('alertas/gacetillas', [
        'uses' => 'Alertas\AlertaController@gacetillas',
        'as'   => 'alertas::gacetillas'
    ]);

    Route::get('alertas/estado-servicio', [
        'uses' => 'Alertas\AlertaController@getEstadoServicio',
        'as'   => 'alertas::estado-servicio'
    ]);

    Route::get('alertas/hoy/layer', [
        'uses' => 'Alertas\AlertaController@hoyLayer',
        'as'   => 'alertas::hoy.layer'
    ]);

    Route::get('alertas/vigentes/layer', [
        'uses' => 'Alertas\AlertaController@vigentesLayer',
        'as'   => 'alertas::vigentes.layer'
    ]);

    Route::get('alertas/futuras/layer', [
        'uses' => 'Alertas\AlertaController@futurasLayer',
        'as'   => 'alertas::futuras.layer'
    ]);

    /**
        * Oficina Virtual
        */

    Route::post('oficina-virtual/libre-deuda', [
        'uses' => 'OficinaVirtual\PedidoController@solicitarLibreDeuda',
        'as'   => 'oficicina-virtual::pedidos.solicitar.libre-deuda'
    ]);

    Route::post('oficina-virtual/facturas-vencidas', [
        'uses' => 'OficinaVirtual\PedidoController@solicitarFacturasVencidas',
        'as'   => 'oficicina-virtual::pedidos.solicitar.facturas-vencidas'
    ]);

    Route::get('oficina-virtual/boletas-pago', [
        'uses' => 'OficinaVirtual\BoletaPagoController@generar',
        'as'   => 'oficicina-virtual::boletas-pago.generar'
    ]);

    /**
        * Turnos
        */
    Route::group([
        'namespace' => 'Turnos',
        'prefix'    => 'turnos',
        'as'        => 'turnos::'
    ], function()
    {
        Route::post('/', [
            'uses' => 'TurnoController@store',
            'as'   => 'store'
        ]);

        Route::get('actividades/{id}',[
            'uses' => 'ActividadController@show',
            'as'   => 'actividades.show'
        ])->where('id', '[0-9]+');

        Route::get('actividades/{id}/turnos-asignados',[
            'uses' => 'ActividadController@turnosAsignados',
            'as'   => 'actividades.turnos-asignados'
        ])->where('id', '[0-9]+');
    });

}); // v1 group


// v2
Route::group(['prefix' => 'v2'], function () {

    /**
    * Solicitudes
    */
    Route::group(['namespace'  => 'Solicitudes', 'prefix' => 'solicitudes'], function()
    {
        Route::resource('estados', 'EstadosController');
        Route::resource('origenes', 'OrigenesController');
        Route::resource('prioridades', 'PrioridadesController');
        Route::resource('tipos', 'TiposController');
        Route::resource('solicitantes', 'SolicitantesController');
        Route::resource('solicitudes', 'SolicitudesController');
        Route::resource('areas', 'AreasController');
        Route::resource('agentes', 'AgentesController');
        Route::resource('derivaciones', 'DerivacionesController');
    });// Solicitudes

});
// v2 -> end
