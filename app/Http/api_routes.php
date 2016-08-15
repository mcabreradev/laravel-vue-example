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
                //return response($e->getMessage(), 500);
                return response('Error al suscribirse', 500);
            }

        });

        Route::get('oficina-virtual/boletas-pago', [
            'uses' => 'OficinaVirtual\BoletaPagoController@generar',
            'as'   => 'oficicina-virtual::boleta.pago.generar'
        ]);

        Route::get('nivel-agua-plantas', function()
        {
            $registro = App\Models\Plantas\NivelAguaPlantaRegistro::orderBy('registrado_el', 'desc')
                ->with('nivelAguaPlanta')
                ->first();

            $response = [
                'nivel'         => $registro->nivelAguaPlanta->id,
                'titulo'        => $registro->nivelAguaPlanta->titulo,
                'etiqueta'      => $registro->nivelAguaPlanta->etiqueta,
                'descripcion'   => $registro->nivelAguaPlanta->descripcion,
                'registrado_el' => $registro->registrado_el
            ];

            return response()->json($response, 200);
        });

        // Route::get('alertas/gacetillas');

        Route::get('alertas/vigentes/layer', [
            'uses' => 'Alertas\AlertaController@vigentesLayer',
            'as'   => 'alertas.vigentes.layer'
        ]);

        Route::get('alertas/futuras/layer', [
            'uses' => 'Alertas\AlertaController@futurasLayer',
            'as'   => 'alertas.futuras.layer'
        ]);

        Route::post('pedidos/libre-deuda', [
            'uses' => 'OficinaVirtual\PedidoController@solicitarLibreDeuda'
        ]);

    }); // v1 group
}); // api group
