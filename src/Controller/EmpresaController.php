<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Oauth2Server;
use App\Model\Storage\AccessToken;
use Cake\Event\Event;
use WebDevBr\OAuth2\Token;
use Cake\ORM\TableRegistry;
use Cake\Datasource\Exception\RecordNotFoundException;
use Exception;

/**
 * Empresa Controller
 *
 * @property \App\Model\Table\EmpresaTable $Empresa
 *
 * @method \App\Model\Entity\Empresa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmpresaController extends AppController
{
    
    public function beforeRender(Event $event) {
        parent::beforeRender($event);
    }
    
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['client', 'oauth', 'oauthFull', 'getByCnpj', 'primeiroAcesso', 'recoverPassword']);
        $this->viewBuilder()->setLayout('ajax');
    }
    
    public function client()
    {
        $token = new \stdClass();
        $server = (new Oauth2Server)->getInstance();

        $token->authorization = $server->clientAuthorization();
        $this->set(['token' => $token]);
        $this->set('_serialize', ['token']);
    }

    public function oauth()
    {
        $this->request->allowMethod(['post']);
        $this->Auth->setConfig('authenticate', [
            'Form' => ['userModel' => 'Empresa', 'fields' => ['username' => 'cnpj', 'password' > 'senha']]
        ]);

        if (!$this->Auth->identify()) {
            throw new UnauthorizedException('Usuário não autorizado');
        }

        try {
            $token = new \stdClass();
            $server = (new Oauth2Server)->getInstance();
            $token->authorization = $server->accessAuthorization();
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
        $this->set(['token' => $token]);
        $this->set('_serialize', ['token']);
    }

    public function oauthFull()
    {
        $this->request->allowMethod(['post']);

        $server = (new Oauth2Server)->getInstance();
        $server->clientAuthorization();

        $this->Auth->setConfig('authenticate', [
            'Form' => ['userModel' => 'Empresa', 'fields' => ['username' => 'cnpj', 'password' => 'senha']]
        ]);

        if (!$this->Auth->identify()) {
            throw new Exception('Empresa não autorizado');
        }
        $empresa = $this->Auth->identify();
        $empresa = $this->Empresa->get($empresa['id']);

        try {
            $token = new \stdClass();
            $access_token = (new AccessToken)->setModel(TableRegistry::get('Oauth2Tokens'));
            $token->authorization = (new Token)->generate($access_token);
            $empresa->dataExpiracao = new \DateTime;
            $empresa->dataExpiracao->add(new \DateInterval('PT10H'));
            $empresa->manterConectado = $this->request->getData('keepConnected')=='true' ? 1:0;
            $this->Empresa->save($empresa);
            $empresa->role = 'empresa';
            $this->loadModel('EmpresaPagamentos');
            !empty($this->EmpresaPagamentos->find('all')->where(['empresa_id' => $empresa->id])->toArray()) ? $empresa->pagamento = true: $empresa->pagamento = false;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
        $this->set(compact('token', 'empresa'));

    }

    /**
     * View method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($cnpj = null)
    {
        $this->request->allowMethod(['get']);
        $empresa = $this->Empresa->find('all')->where(['cnpj' => $cnpj])->first();
        $message = '';
        if(!empty($empresa))
            $message = 'success';
        else
            $message = 'Empresa não localizada em nossa base de dados.';
        
        $this->set(compact('empresa', 'message'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
//    public function add()
//    {
//        $empresa = $this->Empresa->newEntity();
//        if ($this->request->is('post')) {
//            $empresa = $this->Empresa->patchEntity($empresa, $this->request->getData());
//            if ($this->Empresa->save($empresa)) {
//                $this->Flash->success(__('The empresa has been saved.'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The empresa could not be saved. Please, try again.'));
//        }
//        $cidade = $this->Empresa->Cidade->find('list', ['limit' => 200]);
//        $atividade = $this->Empresa->Atividade->find('list', ['limit' => 200]);
//        $escritorio = $this->Empresa->Escritorio->find('list', ['limit' => 200]);
//        $categoria = $this->Empresa->Categoria->find('list', ['limit' => 200]);
//        $usuario = $this->Empresa->Usuario->find('list', ['limit' => 200]);
//        $email = $this->Empresa->Email->find('list', ['limit' => 200]);
//        $this->set(compact('empresa', 'cidade', 'atividade', 'escritorio', 'categoria', 'usuario', 'email'));
//    }

    /**
     * Edit method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['get']);
        $message = '';
        
        try{
            $empresa = $this->Empresa->get($id);
            $empresa = $this->Empresa->patchEntity($empresa, $this->request->getData());
            if ($this->Empresa->save($empresa)) 
                $message = 'success';
            else
                $message = 'error';
        }catch(RecordNotFoundException $ex){
            $message = $ex->getMessage();
        }
        catch(Exception $ex){
            $message = $ex->getMessage();
        }

        $this->set(compact('empresa', 'message'));
    }
    
    public function primeiroAcesso($id = null)
    {
        $this->request->allowMethod(['post']);
        $message = '';
        
        try{
            $empresa = $this->Empresa->get($id);
            if(empty($empresa->senha)){
                $empresa->senha = $this->request->getData('senha');
                $empresa->email = $this->request->getData('email');
                if($this->Empresa->save($empresa)) 
                    $message = 'success';
                else
                    $message = 'error';
            }
            else{
                $message = 'Seu acesso ao nosso app já foi liberado.';
            }
        }catch(RecordNotFoundException $ex){
            $message = $ex->getMessage();
        }
        catch(Exception $ex){
            $message = $ex->getMessage();
        }

        $this->set(compact('empresa', 'message'));
    }
    
    public function getPagamento($id = null)
    {
        $this->request->allowMethod(['get']);
        $this->loadModel('EmpresaPagamentos');
        $pagamentos = $this->EmpresaPagamentos->find('all')->where(['status' => 3, 'empresa_id' => $id])->toArray();
        
        $this->set(compact('pagamentos'));
    }
    
    public function getByCnpj()
    {
        $this->request->allowMethod(['post']);
        $cnpj = $this->request->getData('cnpj');
        $empresa = $this->Empresa->find('all')->where(['cnpj' => $cnpj])->first();
        $message = '';
        if(!empty($empresa))
            $message = 'success';
        else
            $message = 'Empresa não localizada na base de dados. Entre em contato com o sindicato.';
        
        $this->set(compact('empresa', 'message'));
    }
    
    public function recoverPassword()
    {
        $this->request->allowMethod(['post']);
        $cnpj = $_POST['cnpj'];
        if($cnpj){
            $empresa = $this->Empresa->find('all')->where(['cnpj' => $cnpj])->first();
            if(!empty($empresa)){
                $password = $this->Funcoes->gerarSenha(5, true, true, true, false);
                $empresa->senha = $password;
                if($this->Empresa->save($empresa)){
                    $empresa->nome = $empresa->razaoSocial;
                    $status = $this->Funcoes->enviarSenha($empresa, $password);
                    if($status == 'success'){
                        $message = 'success';
                    }
                    else{
                        $message = 'Falha ao enviar email. Tente novamente.';
                    }
                }
                else{
                    $message = 'Falha ao tentar alterar sua senha. Tente novamente';
                }
            }
            else{
                $message = 'CNPJ não cadastrado no sistema.';
            }
        }
        else{
            $message = 'Informe um CNPJ válido.';
        }
        
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
    }
}
