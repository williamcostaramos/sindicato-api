<?php

namespace App\Model\Storage;

abstract class Storage
{
    protected $model;
    
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
    
    public function getModel()
    {
        return $this->model;
    }
}