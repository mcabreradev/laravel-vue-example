<?php

/**
 * Auth
 */
Route::group([
    'namespace' => 'Auth',
    'as'        => 'auth::'
], function() {

    Route::get('login', [
        'as'   => 'login.form',
        'uses' => 'AuthController@showLoginForm'
    ]);

    Route::post('login', [
        'as'   => 'login',
        'uses' => 'AuthController@login'
    ]);

    Route::get('logout', [
        'as'   => 'logout',
        'uses' => 'AuthController@logout'
    ]);

    Route::get('register', [
        'as'   => 'register.form',
        'uses' => 'AuthController@showRegistrationForm'
    ]);

    Route::post('register', [
        'as'   => 'register',
        'uses' => 'AuthController@register'
    ]);

    Route::get('password/reset/{token?}', [
        'as'   => 'password.reset.form',
        'uses' => 'PasswordController@showResetForm'
    ]);

    Route::post('password/reset', [
        'as'   => 'password.reset',
        'uses' => 'PasswordController@reset'
    ]);

    Route::post('password/email', [
        'as'   => 'password.email',
        'uses' => 'PasswordController@sendResetLinkEmail'
    ]);

    Route::get('verification/{token}', [
        'as'   => 'email.verification',
        'uses' => 'AuthController@getVerification'
    ]);

    Route::get('verification/error', [
        'as'   => 'email.verification.error',
        'uses' => 'AuthController@getVerificationError'
    ]);
});
