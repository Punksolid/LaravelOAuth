<?php

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
Route::post('get_access_token', function (Request $request) {
    /** @var \App\User $user */
    $user = \App\User::where('email', $request->username )->first();
    $token = $user->createToken('whatever');
    $client = \Laravel\Passport\Passport::client();
    \Laravel\Passport\Passport::actingAsClient($client);
    return \Illuminate\Http\JsonResponse::create([
        'access_token' => 'client_credentials',
        'refresh_token' => 'client-id',
        'expires_in' => 'client-secret',
        'user_id' => $user->id,
    ]);
} );
Route::middleware('client')->resource('tasks','TaskController');
//Route::resource('tasks','TaskController');
