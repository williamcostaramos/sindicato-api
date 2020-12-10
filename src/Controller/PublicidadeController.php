<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * Publicidade Controller
 *
 * @property \App\Model\Table\PublicidadeTable $Publicidade
 *
 * @method \App\Model\Entity\Publicidade[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PublicidadeController extends AppController
{
    public function beforeRender(Event $event) {
        parent::beforeRender($event);
    }
    
    
    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->setLayout('ajax');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $query = $this->Publicidade->find('all')->order(['id' => 'desc']);
        try{
            $publicidades = $this->paginate($query);
        }catch(NotFoundException $ex){
            $publicidades = [];
        }
        $this->set(compact('publicidades'));
    }

    /**
     * View method
     *
     * @param string|null $id Publicidade id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//    public function view($id = null)
//    {
//        $publicidade = $this->Publicidade->get($id, [
//            'contain' => []
//        ]);
//
//        $this->set('publicidade', $publicidade);
//    }
}
