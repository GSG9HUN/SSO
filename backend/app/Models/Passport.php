<?php

namespace App\Models;

use Laravel\Passport\Client;

class Passport extends Client
{
    public function skipsAuthorization(): bool
    {
        // I have to skip this only if the client is mine...
        // Have to think about it later...
        return true;
    }

}
