<?php

Route::group(['namespace' => 'Api'] ,function (){
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'AuthController@register')->name('api.register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refresh');
    });

    Route::group(['middleware'=>['auth:api','jwt.auth','auth_type:2']],function (){
        Route::group(['prefix' => 'account'], function () {
            Route::get('/me','ProfileController@me');
            Route::post('/update','ProfileController@update')->name('api.account.update');
            Route::post('/update-password','ProfileController@updatePassword');

        });
        Route::get('/forms','FormController@index');
        Route::get('/forms/{form}','FormController@show');
    });
});
