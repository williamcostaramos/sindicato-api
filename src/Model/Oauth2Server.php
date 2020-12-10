<?php

namespace App\Model;

use App\Model\Storage\Client;
use App\Model\Storage\AccessToken;
use App\Model\Storage\AuthenticationToken;
use Cake\ORM\TableRegistry;
use WebDevBr\OAuth2\Server;


class Oauth2Server
{
    public function getInstance()
    {
        $server = new Server;
        $server->setClientStorage((new Client)->setModel(TableRegistry::get('Oauth2Clients'))).
        $server->setAccessTokenStorage((new AccessToken)->setModel(TableRegistry::get('Oauth2Tokens'))).
        $server->setAuthenticationTokenStorage((new AuthenticationToken)->setModel(TableRegistry::get('Oauth2Tokens')));
        
        return $server;
    }
}