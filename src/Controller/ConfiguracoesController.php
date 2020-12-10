<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class ConfiguracoesController extends AppController
{
    public function beforeRender(Event $event) 
    {
        parent::beforeRender($event);
    }
    
    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->setLayout('ajax');
    }
    
    public function get()
    {
        $this->request->allowMethod('get');
        $this->loadModel('AppConfiguracoes');
        $configuracoes = $this->AppConfiguracoes->find('all')->first();
        $habilitarCobranca = $configuracoes->habilitarCobranca;
        $valorTaxa = $configuracoes->valorTaxa;
        
        $this->set(compact('habilitarCobranca', 'valorTaxa'));
    }
}

