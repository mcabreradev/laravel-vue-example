<?php

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
        'uses' => 'NivelAguaController@index',
        'middleware' => ['ability:admin,alertas-nivel-agua-browse'],
    ]);

    Route::post('niveles-agua', [
        'as'   => 'niveles-agua.store',
        'uses' => 'NivelAguaController@store',
        'middleware' => ['ability:admin,alertas-nivel-agua-add'],
    ]);

    Route::delete('niveles-agua/{id}', [
        'as'   => 'niveles-agua.destroy',
        'uses' => 'NivelAguaController@destroy',
        'middleware' => ['ability:admin,alertas-nivel-agua-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Registro de nivel de agua en plantas
     */

    Route::get('/registros-nivel-agua', [
        'as'   => 'registros-nivel-agua.index',
        'uses' => 'NivelAguaRegistroController@index',
        'middleware' => ['ability:admin,alertas-nivel-agua-browse'],
    ]);

    Route::post('/registros-nivel-agua', [
        'as'   => 'registros-nivel-agua.store',
        'uses' => 'NivelAguaRegistroController@store',
        'middleware' => ['ability:admin,alertas-nivel-agua-add'],
    ]);

    Route::delete('/registros-nivel-agua/{id}', [
        'as'   => 'registros-nivel-agua.destroy',
        'uses' => 'NivelAguaRegistroController@destroy',
        'middleware' => ['ability:admin,alertas-nivel-agua-delete'],
    ])->where('id', '[0-9]+');

    /**
     * Alerta mapa
     */

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'AlertaController@index',
        'middleware' => ['ability:admin,alertas-mapa-browse'],
    ]);

    Route::get('/create', [
        'as'   => 'create',
        'uses' => 'AlertaController@create',
        'middleware' => ['ability:admin,alertas-mapa-add'],
    ]);

    Route::get('/create/layer', [
        'as'   => 'create.layer',
        'uses' => 'AlertaController@createLayer',
        'middleware' => ['ability:admin,alertas-mapa-add'],
    ]);

    Route::post('/', [
        'as'   => 'store',
        'uses' => 'AlertaController@store',
        'middleware' => ['ability:admin,alertas-mapa-add'],
    ]);

    Route::get('/edit/{id}', [
        'as'   => 'edit',
        'uses' => 'AlertaController@edit',
        'middleware' => ['ability:admin,alertas-mapa-edit'],
    ]);

    Route::get('/edit/{id}/layer', [
        'as'   => 'edit.layer',
        'uses' => 'AlertaController@editLayer',
        'middleware' => ['ability:admin,alertas-mapa-edit'],
    ]);

    Route::delete('/{id}', [
        'as'   => 'destroy',
        'uses' => 'AlertaController@destroy',
        'middleware' => ['ability:admin,alertas-mapa-edit'],
    ])->where('id', '[0-9]+');

    /**
     * Aleta mapa Estados
     */

    Route::get('estados', [
        'as'   => 'estados.index',
        'uses' => 'EstadoController@index',
        'middleware' => ['ability:admin,alertas-mapa-browse'],
    ]);

    Route::post('estados', [
        'as'   => 'estados.store',
        'uses' => 'EstadoController@store',
        'middleware' => ['ability:admin,alertas-mapa-add'],
    ]);

    Route::delete('estados/{id}', [
        'as'   => 'estados.destroy',
        'uses' => 'EstadoController@destroy',
        'middleware' => ['ability:admin,alertas-mapa-delete'],
    ])->where('id', '[0-9]+');
}); // alertas group
