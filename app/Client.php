<?php

namespace App;

use \Laravel\Passport\Client as PassportClient;

class Client extends PassportClient
{
    public function skipsAuthorization(): bool
    {
//        return parent::skipsAuthorization(); // TODO: Change the autogenerated stub
        return true;
    }
}
