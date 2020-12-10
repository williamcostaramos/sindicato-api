<?php

namespace App\Model\Storage;

use WebDevBr\OAuth2\Storage\StorageInterface;

class AuthenticationToken extends Storage implements StorageInterface
{
    
    protected $type = 1;
    
    public function get($id) {
        $model = $this->getModel();
        return $model->find()
            ->where([
                'Oauth2Tokens.auth_token' => $this->type, 
                'Oauth2Tokens.token' => $id,   
                'Oauth2Tokens.expiration_date >=' => (new \DateTime)->format('Y-m-d H:i:s')
                ])
            ->first();
    }

    public function insert(\stdClass $data) {
        $expiration_date = new \DateTime;
        $expiration_date->add(new \DateInterval('PT12H'));
        
        $data->auth_token = $this->type;
        
        $model = $this->getModel();
        $entity = $model->newEntity();
        $entity = $model->patchEntity($entity, (array)$data);
        $entity->expiration_date = $expiration_date->format('Y-m-d H:i:s');
        
        return (bool)$model->save($entity);
    }

    public function remove($id) {
        $entity = $this->getModel()->find()
            ->where([
                'Oauth2Tokens.auth_token' => $this->type, 
                'Oauth2Tokens.token' => $id
                ])
            ->first();
        if(!$entity)
            return false;
        return $this->getModel()->delete($entity);
    }

}