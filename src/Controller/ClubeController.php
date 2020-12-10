<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Clube Controller
 *
 * @property \App\Model\Table\ClubeTable $Clube
 *
 * @method \App\Model\Entity\Clube[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClubeController extends AppController
{
    public function beforeRender(Event $event) 
    {
        parent::beforeRender($event);
    }
    
    public function beforeFilter(Event $event)
    {
        $this->viewBuilder()->setLayout('ajax');
    }
    /**
     * View method
     *
     * @param string|null $id Clube id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $this->request->allowMethod(['get']);
        $clube = $this->Clube->find('all')->first();

        $this->set(compact('clube'));
    }

    public function getFotos($idClube = null)
    {
        $this->request->allowMethod(['get']);
        $this->loadModel('ClubeFotos');
        
        $query = $this->ClubeFotos->find('all')->where(['clube_id' => $idClube])->order(['id' => 'desc']);
        try{
            $fotos = $this->paginate($query);
        }catch(NotFoundException $ex){
            $fotos = [];
        }
        
        $this->set(compact('fotos'));
    }
   
}
