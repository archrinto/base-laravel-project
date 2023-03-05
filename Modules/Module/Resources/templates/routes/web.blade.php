--php-open-tag--

Route::prefix('{{ $module['key'] }}')
    ->name('{{ $module['key'] }}:')
    ->group(function() {
        @if(in_array('index', $actions))

        Route::get('/', '{{ $resource['model'] }}IndexController@index')->name('index');
        @endif
        @if(in_array('create', $actions))

        Route::get('/create', '{{ $resource['model'] }}CreateController@index')->name('create');
        Route::post('/create', '{{ $resource['model'] }}CreateController@store')->name('store');
        @endif
        @if(in_array('detail', $actions))

        Route::get('/{id}/detail', '{{ $resource['model'] }}DetailController@index')->name('detail');
        @endif
        @if(in_array('edit', $actions))

        Route::get('/{id}/edit', '{{ $resource['model'] }}EditController@index')->name('edit');
        Route::post('/{id}/edit', '{{ $resource['model'] }}EditController@store')->name('update');
        @endif
        @if(in_array('index', $actions))

        Route::get('/{id}/delete', '{{ $resource['model'] }}DeleteController@index')->name('delete');
        @endif

    });
