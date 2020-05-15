<?php

namespace App\Providers;

use App\Client;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\AuthCode;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes();

//        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
//        Passport::useAuthCodeModel(AuthCode::class);
//        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
    }
}
