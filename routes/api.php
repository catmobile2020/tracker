<?php

Route::group(['namespace' => 'Api'] ,function (){
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'AuthController@register')->name('api.register');
        Route::post('login', 'AuthController@login');
        Route::get('logout', 'AuthController@logout');
        Route::get('refresh', 'AuthController@refresh');
    });

    Route::group(['middleware'=>['auth:api','jwt.auth']],function (){
        Route::group(['prefix' => 'account'], function () {
            Route::get('/me','ProfileController@me');
            Route::post('/update','ProfileController@update')->name('api.account.update');
            Route::post('/update-password','ProfileController@updatePassword');

            Route::get('/my-orders','ProfileController@myOrders');
            Route::get('/my-orders/{order}','ProfileController@singleOrder');
        });

        Route::get('/pharmacies','PharmacyController@index');
        Route::get('/pharmacies/{pharmacy}','PharmacyController@singlePharmacy');

    });
});
