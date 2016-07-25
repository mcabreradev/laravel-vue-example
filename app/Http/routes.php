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
     * Nivel de Agua en Plantas
     */
    Route::get('/nivel-agua-plantas', [
        'as'   => 'plantas.niveles.index',
        'uses' => 'Plantas\NivelAguaPlantaController@index'
    ]);

    Route::post('/nivel-agua-plantas', [
        'as'   => 'plantas.niveles.store',
        'uses' => 'Plantas\NivelAguaPlantaController@store'
    ]);

    Route::delete('/nivel-agua-plantas/{id}', [
        'as'   => 'plantas.niveles.destroy',
        'uses' => 'Plantas\NivelAguaPlantaController@destroy'
    ])->where('id', '[0-9]+');

    /**
     * Registro de nivel de agua en plantas
     */
    Route::get('/historico-nivel-agua-plantas', [
        'as'   => 'plantas.niveles.registros.index',
        'uses' => 'Plantas\NivelAguaPlantaRegistroController@index'
    ]);

    Route::post('/historico-nivel-agua-plantas', [
        'as'   => 'plantas.niveles.registros.store',
        'uses' => 'Plantas\NivelAguaPlantaRegistroController@store'
    ]);

    Route::delete('/historico-nivel-agua-plantas/{id}', [
        'as'   => 'plantas.niveles.registros.destroy',
        'uses' => 'Plantas\NivelAguaPlantaRegistroController@destroy'
    ])->where('id', '[0-9]+');

    /**
     * Cortes: Estados
     */
    Route::get('/cortes/estados', [
        'as'   => 'cortes.estados.index',
        'uses' => 'Cortes\EstadoController@index'
    ]);

    Route::post('/cortes/estados', [
        'as'   => 'cortes.estados.store',
        'uses' => 'Cortes\EstadoController@store'
    ]);

    Route::delete('/cortes/estados/{id}', [
        'as'   => 'cortes.estados.destroy',
        'uses' => 'Cortes\EstadoController@destroy'
    ])->where('id', '[0-9]+');


    /**
     * Cortes: Situaciones
     */
    Route::get('/cortes/situaciones', [
        'as'   => 'cortes.situaciones.index',
        'uses' => 'Cortes\SituacionController@index'
    ]);

    Route::get('/cortes/situaciones/create', [
        'as'   => 'cortes.situaciones.create',
        'uses' => 'Cortes\SituacionController@create'
    ]);

    Route::post('/cortes/situaciones', [
        'as'   => 'cortes.situaciones.store',
        'uses' => 'Cortes\SituacionController@store'
    ]);

    Route::delete('/cortes/situaciones/{id}', [
        'as'   => 'cortes.situaciones.destroy',
        'uses' => 'Cortes\SituacionController@destroy'
    ])->where('id', '[0-9]+');

    /**
     * Cortes: Barrios
     */
    Route::get('/barrios/layer', [
        'as'   => 'barrios.layer',
        'uses' => 'Cortes\SituacionController@getLayer'
    ]);
});
