<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;


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
Route::prefix('v1')->middleware('api')->group(function () {
    Route::apiResource('users', UserController::class);
});

Route::get('users', 'UserController@index');
Route::post('users', 'UserController@create');
Route::get('/users/{id}', 'UserController@detail');
Route::put('/users/{id}', 'UserController@update');
Route::delete('/users/{id}', 'UserController@delete');

?>