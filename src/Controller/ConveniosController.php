<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Exception;

/**
 * Convenios Controller
 *
 * @property \App\Model\Table\ConveniosTable $Convenios
 *
 * @method \App\Model\Entity\Convenio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConveniosController extends AppController
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
        $this->request->allowMethod(['get']);
        $query = $this->Convenios->find('all')->order(['id' => 'desc']);
        try{
            $convenios = $this->paginate($query);
        }catch(NotFoundException $ex){
            $convenios = [];
        }

        $this->set(compact('convenios'));
    }

    /**
     * View method
     *
     * @param string|null $id Convenio id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//    public function view($id = null)
//    {
//        $convenio = $this->Convenios->get($id, [
//            'contain' => []
//        ]);
//
//        $this->set('convenio', $convenio);
//    }
}
