<?php

Route::prefix('example')
    ->name('example:')
    ->group(function() {

        Route::get('/', 'ExampleIndexController@index')->name('index');

        Route::get('/create', 'ExampleCreateController@index')->name('create');
        Route::post('/create', 'ExampleCreateController@store')->name('store');

        Route::get('/{id}/detail', 'ExampleDetailController@index')->name('detail');

        Route::get('/{id}/edit', 'ExampleEditController@index')->name('edit');
        Route::post('/{id}/edit', 'ExampleEditController@store')->name('update');

        Route::get('/{id}/delete', 'ExampleDeleteController@index')->name('delete');

    });
