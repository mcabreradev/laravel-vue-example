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
Route::group([], function() {

    Route::get('/login', [
        'as'   => 'auth::login.form',
        'uses' => 'Auth\AuthController@showLoginForm'
    ]);

    Route::post('/login', [
        'as'   => 'auth::login',
        'uses' => 'Auth\AuthController@login'
    ]);

    Route::get('/logout', [
        'as'   => 'auth::logout',
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
    Route::get('/pedidos', [
        'as'   => 'pedidos.index',
        'uses' => 'OficinaVirtual\PedidosController@index'
    ]);
});