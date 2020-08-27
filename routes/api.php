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

Route::post('register', 'Api\ApiAuthController@register');
Route::post('login', 'Api\ApiAuthController@login')->name('login');

Route::group(['prefix' => 'auth'], function () {

    Route::post('create', 'PasswordResetController@create');
    Route::post('reset', 'PasswordResetController@reset')->name('reset');
    Route::get('find/{email}', 'PasswordResetController@find');

Route::group(['middleware' => 'auth:api'], function() { 
    	Route::get('logout', 'Api\ApiAuthController@logout');
    	Route::get('user', 'Api\ApiAuthController@user');
});

});

// routes logica

Route::get( 'listusers', 'InventarioController@listUser' );
Route::post( 'crearitem', 'ItemsController@crearItem' );
Route::get( 'listaritems', 'ItemsController@listarItems' );
Route::get( 'listaritem/{id}', 'ItemsController@listarItem' );
Route::put( 'editaritem', 'ItemsController@editarItem' );

Route::post( 'ingresoshare', 'InventarioController@ingresoShare' );