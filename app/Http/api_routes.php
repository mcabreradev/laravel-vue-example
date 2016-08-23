<?php

/**
 * HOME
 */
Route::group([
    'prefix' => 'api',
    'as'     => 'api::'
], function()
{
    Route::group([
        'prefix' => 'v1',
        'as'     => 'v1::'
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

    }); // v1 group
}); // api group
