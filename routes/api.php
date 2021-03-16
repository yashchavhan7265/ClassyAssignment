<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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

Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@show');
Route::post('/users', 'UserController@store');
Route::put('/users/{id}', 'UserController@update');
Route::delete('/users/{id}', 'UserController@destroy');
Route::get('/users/{id}/user_address', 'AddressController@show');
Route::get('/user_address/{id}', 'AddressController@index');
Route::post('/users/{id}/user_address', 'AddressController@store');
Route::put('/user_address/{id}', 'AddressController@update');
Route::delete('/user_address/{id}', 'AddressController@destroy');
