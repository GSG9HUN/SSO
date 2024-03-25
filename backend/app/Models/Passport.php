<?php

namespace App\Models;

use Laravel\Passport\Client;

class Passport extends Client
{
    public function skipsAuthorization(): false
    {
        return false;
    }

}
