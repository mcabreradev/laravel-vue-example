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

        Route::get('cortes/situaciones', function()
        {

            function generarLayer($barriosSituaciones)
            {
                $layer = [
                    'type' => 'FeatureCollection',
                    'features' => []
                ];

                foreach ($barriosSituaciones as $barSit) {
                    $feature = [
                        'type' => 'Feature',
                        'properties' => [
                            'nombre' => $barSit->barrio->nombre,
                            'estado' => $barSit->estado->id,
                            'descripcion' => $barSit->estado->titulo
                        ],
                        'geometry' => [
                            'type' => 'Polygon',
                            'coordinates' => $barSit->barrio->geometria->coordinates
                        ],
                    ];

                    $layer['features'][] = $feature;
                }

                return $layer;
            }

            function barriosAfectados($barriosSituaciones)
            {
                $barrios = [];

                foreach ($barriosSituaciones as $barSit) {
                    if (array_key_exists($barSit->estado->titulo, $barrios)) {
                        $barrios[$barSit->estado->titulo][] = $barSit->barrio->nombre;
                    }
                    else {
                        $barrios[$barSit->estado->titulo] = [$barSit->barrio->nombre];
                    }
                }

                return $barrios;
            }

            $situacion = App\Models\Cortes\Situacion::orderBy('inicia_el', 'desc')
                ->with('barriosSituaciones')
                ->with('barriosSituaciones.barrio')
                ->with('barriosSituaciones.estado')
                ->first();

            $response = [
                'barrios'     => barriosAfectados($situacion->barriosSituaciones),
                'layer'       => generarLayer($situacion->barriosSituaciones),
                'inicio'      => $situacion->inicia_el->format('Y-m-d H:i:s'),
                'fin'         => $situacion->finaliza_el->format('Y-m-d H:i:s')
            ];


            return response()->json($response, 200);
        });

    });
});
