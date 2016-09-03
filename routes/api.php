<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('accounts', 'AccountController', [
    'names' => [
        'index'   => 'account_api.index',
        'create'  => 'account_api.create',
        'store'   => 'account_api.store',
        'show'    => 'account_api.show',
        'edit'    => 'account_api.edit',
        'update'  => 'account_api.update',
        'destroy' => 'account_api.destroy',
    ]
]);
