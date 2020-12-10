<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Informacao Controller
 *
 * @property \App\Model\Table\InformacaoTable $Informacao
 *
 * @method \App\Model\Entity\Informacao[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InformacaoController extends AppController
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
        $query = $this->Informacao->find('all')->order(['id' => 'desc']);
        try{
            $informacoes = $this->paginate($query);
        }catch(NotFoundException $ex){
            $informacoes = [];
        }
        $this->set(compact('informacoes'));
    }
    
    public function download($id)
    {
        $this->request->allowMethod(['post']);
        $informacao = $this->Informacao->get($id);
        $url = $this->request->getData('url');
        if($url != ''){
            $extensao = explode('.', $informacao->anexo)[1];
            $file_path = $url.'\docs'.DS.$informacao->anexo;print_r($file_path);exit();
            $this->response->file($file_path, array(
                'download' => true,
                'name' => $informacao->titulo.'.'.$extensao,
            ));
            return $this->response;
        }
    }

    /**
     * View method
     *
     * @param string|null $id Informacao id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
//    public function view($id = null)
//    {
//        $informacao = $this->Informacao->get($id, [
//            'contain' => []
//        ]);
//
//        $this->set('informacao', $informacao);
//    }

   
}
