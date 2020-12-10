<?php

namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Network\Request;
use Cake\Network\Response;
use App\Model\Oauth2Server;
use Cake\Http\Exception\UnauthorizedException;

class OAuth2Authenticate extends BaseAuthenticate
{
    public function authenticate(Request $request, Response $response)
    {
    }

    public function unauthenticated(Request $request, Response $response)
    {
        $isValid = (new Oauth2Server)->getInstance()->requestIsValid();
        if(!$isValid) {
            throw new UnauthorizedException;
        }
        return false;
    }
}
