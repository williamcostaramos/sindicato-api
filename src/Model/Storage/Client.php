<?php

namespace App\Model\Storage;

use WebDevBr\OAuth2\Storage\StorageInterface;

class Client extends Storage implements StorageInterface
{
    public function get($id) {
        $model = $this->getModel();
        return $model->find()
            ->where(['client_id' => $id])
            ->first();
    }

    public function insert(\stdClass $data) {
        $model = $this->getModel();
        $entity = $model->newEntity();
        $entity = $model->patchEntity($entity, (array)$data);
        
        return $model->save($entity);
    }

    public function remove($id) {
        $entity = $this->getModel()->get($id);
        return $this->getModel()->delete($entity);
    }

}