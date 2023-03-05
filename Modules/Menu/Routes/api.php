<?php

use Modules\Menu\Http\Controllers\MenuApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/menus')
    ->name('menu:api.')
    ->middleware([])
    ->group(function () {
        Route::post('/', [MenuApiController::class, 'datatable'])->name('datatable');
        Route::get('/options', [MenuApiController::class, 'options'])->name('options');
        Route::get('/routes', [MenuApiController::class, 'routes'])->name('routes');
    });
