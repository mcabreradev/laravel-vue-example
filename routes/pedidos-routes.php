<?php

/**
 * Pedidos
 */
Route::get('/pedidos/create', [
    'as'   => 'pedidos.create',
    'uses' => 'OficinaVirtual\PedidoController@create',
    'middleware' => ['ability:admin,pedidos-browse'],
]);

Route::get('/pedidos/edit/{id}', [
    'as'   => 'pedidos.edit',
    'uses' => 'OficinaVirtual\PedidoController@edit',
    'middleware' => ['ability:admin,pedidos-browse'],
])->where('id', '[0-9]+');

Route::put('/pedidos/{id}', [
    'as'   => 'pedidos.update',
    'uses' => 'OficinaVirtual\PedidoController@update',
    'middleware' => ['ability:admin,pedidos-browse'],
])->where('id', '[0-9]+');

Route::delete('/pedidos/{id}', [
    'as'   => 'pedidos.destroy',
    'uses' => 'OficinaVirtual\PedidoController@destroy',
    'middleware' => ['ability:admin,pedidos-browse'],
])->where('id', '[0-9]+');

Route::delete('/pedidos/{id}/enviar-email', [
    'as'   => 'pedidos.enviar.email',
    'uses' => 'OficinaVirtual\PedidoController@enviarEmail',
    'middleware' => ['ability:admin,pedidos-browse'],
])->where('id', '[0-9]+');

Route::post('/pedidos', [
    'as'   => 'pedidos.store',
    'uses' => 'OficinaVirtual\PedidoController@store',
    'middleware' => ['ability:admin,pedidos-browse'],
]);

Route::get('/pedidos/{estado?}', [
    'as'   => 'pedidos.index',
    'uses' => 'OficinaVirtual\PedidoController@index',
    'middleware' => ['ability:admin,pedidos-browse'],
])->where('id', '[a-z]+');

/**
 * Pedido Adjuntos
 */
Route::post('/pedidos-adjuntos', [
    'as'   => 'pedidos.adjuntos.store',
    'uses' => 'OficinaVirtual\PedidoAdjuntoController@store',
    'middleware' => ['ability:admin,pedidos-browse'],
]);

Route::delete('/pedidos-adjuntos/{id}', [
    'as'   => 'pedidos.adjuntos.destroy',
    'uses' => 'OficinaVirtual\PedidoAdjuntoController@destroy',
    'middleware' => ['ability:admin,pedidos-browse'],
])->where('id', '[0-9]+');
