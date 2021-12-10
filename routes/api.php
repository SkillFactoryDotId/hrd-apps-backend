<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\OauthController;


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
    Route::middleware('auth:api')->group(function () {
        // Oauth 2.0
        // https://laravel.com/docs/8.x/passport

        Route::apiResource('users', UserController::class);
        Route::get('me' , [OauthController::class, 'me']);
        Route::post('update-profile' , [OauthController::class, 'updateProfile']);
    });
});

?>