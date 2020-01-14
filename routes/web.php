<?php

Route::group(['prefix'=>'/','namespace'=>'Admin','as'=>'admin.'],function (){
    Route::group(['prefix'=>'/'],function (){
        Route::get('/login','AuthController@index')->name('login');
        Route::post('/login','AuthController@login')->name('login');
        Route::get('/logout','AuthController@logout')->name('logout');
    });

    Route::group(['middleware'=>['auth:web','auth_type:1']],function (){
        Route::get('/','HomeController@index')->name('home');

        Route::get('/profile','ProfileController@index')->name('profile');
        Route::post('/profile','ProfileController@update')->name('profile.update');
        Route::resource('users','UserController');
        Route::get('users/{user}/destroy','UserController@destroy')->name('users.destroy');

        Route::resource('forms','FormController');
        Route::get('forms/{form}/destroy','FormController@destroy')->name('forms.destroy');
        Route::resource('{form}/pages','PageController');
        Route::get('{form}/pages/{page}/destroy','PageController@destroy')->name('pages.destroy');
        Route::resource('{page}/fields','PageFieldsController');
        Route::get('{page}/fields/{field}/destroy','PageFieldsController@destroy')->name('fields.destroy');

    });
});

