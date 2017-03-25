<?php

// rutas de login, logout, register, verify, reset, etc
require(__DIR__.'/auth-routes.php');


Route::get('/test', function(App\Contracts\DpossApiContract $api){

    // caso rosi
    $r = $api->getUltimasBoletas(19401, 26792);
    // o $r = $api->getUltimasBoletas(null, 26792);
    dd($r);

    // // caso rosi periodo 201703
    // $rp = $api->getBoletasPorPeriodo(19401, 26792, 201703);
    // // o $r = $api->getBoletasPorPeriodo(null, 26792, 201703);

    // // caso chino
    // $c = $api->getUltimasBoletas(247, null);

    // // caso chino periodo 201703
    // $cp = $api->getBoletasPorPeriodo(247, null, 201703);

    // dd([$r, $rp, $c, $cp]);
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
     * USERS
     */
    Route::group([
        'as'        => 'users.',
        'prefix'    => 'users'
    ], function() {
        Route::get('dashboard', [
            'as'   => 'dashboard',
            'uses' => 'Admin\UserController@dashboard'
        ]);

        Route::get('profile', [
            'as'   => 'profile.form',
            'uses' => 'Admin\UserController@profile'
        ]);

        Route::put('profile', [
            'as'   => 'profile',
            'uses' => 'Admin\UserController@saveProfile'
        ]);
    });

    // /admin routes
    require(__DIR__.'/admin-routes.php');

    // /pedidos routes
    require(__DIR__.'/pedidos-routes.php');

    // /alertas routes
    require(__DIR__.'/alertas-routes.php');

    // /solicitudes routes
    require(__DIR__.'/solicitudes-routes.php');

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
            'uses' => 'TurnoController@index',
            'middleware' => ['ability:admin,turnos-browse'],
        ]);

        Route::get('asignados/{actividadId}', [
            'as'   => 'asignados-por-actividad',
            'uses' => 'TurnoController@asignadosPorActividad',
            'middleware' => ['ability:admin,turnos-browse'],
        ])->where('actividadId', '[0-9]+');

        Route::get('vencidos/{actividadId}', [
            'as'   => 'vencidos-por-actividad',
            'uses' => 'TurnoController@vencidosPorActividad',
            'middleware' => ['ability:admin,turnos-browse'],
        ])->where('actividadId', '[0-9]+');

        Route::put('validar-atencion/{id}', [
            'as'   => 'validar-atencion',
            'uses' => 'TurnoController@validarAtencion',
            'middleware' => ['ability:admin,turnos-validar-atencion'],
        ])->where('id', '[0-9]+');

        Route::delete('/{id}', [
            'as'   => 'destroy',
            'uses' => 'TurnoController@destroy',
            'middleware' => ['ability:admin,turnos-delete'],
        ])->where('id', '[0-9]+');

    }); // turnos group

    /**
     * OficinaVirtual
     */
    Route::group([
        'namespace' => 'OficinaVirtual',
        'as'        => 'oficina-virtual::',
        'prefix'    => 'oficina-virtual'
    ], function() {

        Route::get('/boletas-de-pago', [
            'as'   => 'boletas-de-pago',
            'uses' => 'BoletaPagoController@main'
        ]);

        Route::post('/boletas-de-pago-query', [
            'as'   => 'boletas-de-pago-query',
            'uses' => 'BoletaPagoController@query'
        ]);

    }); // OficinaVirtual group

}); // middleware auth
