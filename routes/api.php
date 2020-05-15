<?php

use App\Http\Controllers\GetAccessTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('get_access_token', 'GetAccessTokenController');


//Route::middleware('client')->resource('tasks','TaskController');
Route::middleware('auth:api')->resource('tasks','TaskController');
//Route::resource('tasks','TaskController');
