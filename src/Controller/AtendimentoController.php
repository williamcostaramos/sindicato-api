<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * Atendimento Controller
 *
 * @property \App\Model\Table\AtendimentoTable $Atendimento
 *
 * @method \App\Model\Entity\Atendimento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AtendimentoController extends AppController
{
    public function beforeRender(Event $event) {
        parent::beforeRender($event);
    }
    
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->setLayout('ajax');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($idAssociado = null)
    {
        $this->request->allowMethod(['get']);
        $query = $this->Atendimento->find('all')->where(['Atendimento.associado_id' => $idAssociado])->contain(['Tipoatendimento'])->order(['Atendimento.id' => 'desc']);

        try{
            $atendimentos = $this->paginate($query);
        }catch(NotFoundException $ex){
            $atendimentos = [];
        }
        $this->set(compact('atendimentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Atendimento id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $atendimento = $this->Atendimento->get($id, [
            'contain' => ['Departamento', 'Associado', 'Tipoatendimento', 'Usuario', 'Empresa', 'AtendimentoProcedimentos', 'Atendimentoobservacao', 'Atendimentotramitacao']
        ]);

        $this->set('atendimento', $atendimento);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $atendimento = $this->Atendimento->newEntity();
        
        $atendimento = $this->Atendimento->patchEntity($atendimento, $this->request->getData());
        $atendimento->dataOrigem = new \DateTime();
        $message = '';
        if ($this->Atendimento->save($atendimento)) 
            $message = 'success';
        else
            $message = 'error';
        
        $this->set(compact('atendimento', 'message'));
    }
    
    public function getTipos()
    {
        $this->request->allowMethod(['get']);
        $this->loadModel('Tipoatendimento');
        $id = $this->Tipoatendimento->find('all')->where(['descricao' => 'APP'])->first()->id;
        $tiposAtendimento = $this->Tipoatendimento->find('all')->where(['subtipo_id' => $id]);
        
        $this->set(compact('tiposAtendimento'));
    }
}
