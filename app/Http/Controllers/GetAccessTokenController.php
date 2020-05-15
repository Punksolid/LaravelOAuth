<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;

class GetAccessTokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('client');
    }

    public function __invoke(Request $request)
    {
            /** @var User $user */
            $user = User::where('email', $request->username )->first();
//            $client = Passport::set();
//            Passport::actingAsClient($client);


            return JsonResponse::create([
                'access_token' => 'client_credentials',
                'refresh_token' => 'client-id',
                'expires_in' => 'client-secret',
                'user_id' => $user->id,
            ]);

//        return JsonResponse::create([
//            'data' => [
//                'value' => 'The Value'
//            ]
//        ]);
    }
}
