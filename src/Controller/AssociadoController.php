<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Oauth2Server;
use App\Model\Storage\AccessToken;
use Cake\Event\Event;
use WebDevBr\OAuth2\Token;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Exception;
use Mpdf\Mpdf;

class CpfCnpjExceptioin extends Exception 
{
    public $message;
    
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
    }
}

class EmailExceptioin extends Exception 
{
    public $message;
    
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        $this->message = $message;
    }
}
/**
 * Associado Controller
 *
 * @property \App\Model\Table\AssociadoTable $Associado
 *
 * @method \App\Model\Entity\Associado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AssociadoController extends AppController
{

    public function beforeRender(Event $event) {
        parent::beforeRender($event);
    }
    
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['client', 'oauth', 'oauthFull', 'add', 'getByCpf', 'recoverPassword']);
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
            'Form' => ['userModel' => 'Associado', 'fields' => ['username' => 'cpf', 'password' > 'senha']]
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
            'Form' => ['userModel' => 'Associado', 'fields' => ['username' => 'cpf', 'password' => 'senha']]
        ]);

        if (!$this->Auth->identify()) {
            throw new Exception('Usuário não autorizado');
        }
        $associado = $this->Auth->identify();
        $associado = $this->Associado->get($associado['id']);

        try {
            $token = new \stdClass();
            $access_token = (new AccessToken)->setModel(TableRegistry::get('Oauth2Tokens'));
            $token->authorization = (new Token)->generate($access_token);
            $associado->dataExpiracao = new \DateTime;
            $associado->dataExpiracao->add(new \DateInterval('PT10H'));
            $associado->manterConectado = $this->request->getData('keepConnected')=='true' ? 1:0;
            $this->Associado->save($associado);
            $associado->role = 'associado';
        } catch (Exception $ex) {
            echo $ex->getMessage();
            die;
        }
        $this->set(compact('token', 'associado'));

    }
    
    public function freelancers()
    {
        $this->request->allowMethod('get');
        $query = $this->Associado->find('associadoCidade')->where(['Associado.freelancer' => 1])->order(['nome' => 'asc']);
        try{
            $associados = $this->paginate($query);
        }catch(NotFoundException $ex){
            $associados = [];
        }
        
        $this->set(compact('associados'));
    }


    /**
     * View method
     *
     * @param string|null $id Associado id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $associado = $this->Associado->get($id, [
            'contain' => ['Cidade', 'Empresa', 'Profissao', 'Atividade', 'Usuario', 'Categoria', 'Beneficio', 'Email', 'Agenda', 'Associadoanexo', 'Associadobrinde', 'Associadodependente', 'Associadohistorico', 'Associadoobservacao', 'Associadooposicao', 'Atendimento', 'AtendimentoClinico', 'Autorizaconvenio', 'Declaracaoatividaderural', 'Grcsu', 'Guiaassistencial', 'Hospedagem', 'Sms']
        ]);

        $this->set('associado', $associado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);
        $associado = $this->Associado->newEntity();
        $associadoAux = $this->Associado->find('all')->where(['CPF' => $this->request->getData('CPF')])->first();
        $message = '';
        try{
            if(!empty($associadoAux)){
                if(empty($associadoAux->senha)){
                    $associado = $associadoAux;
                }
                else{
                    throw new CpfCnpjExceptioin('Este CPF já está cadastrado em nosso sistema.');
                }
            }
            if(!empty($this->Associado->find('all')->where(['email' => $this->request->getData('email')])->first()))
                throw new EmailExceptioin('Este email já está cadastrado em nosso sistema.');

            $associado = $this->Associado->patchEntity($associado, $this->request->getData());
            $message = '';
            $associado->dataNascimento  = new \DateTime($this->request->getData('dataNascimento'));        
            $associado->situacao = 1;
            $associado->avaliado = 0;
            $associado->freelancer = (bool)$this->request->getData('freelancer');
            $associado->termoAceito = (bool)$this->request->getData('termoAceito');
            if($this->Associado->save($associado))
                $message = 'success';
            else
                $message = 'error';
        } catch (CpfCnpjException $ex){
            $message = $ex->getMessage();
        }catch(EmailExceptioin $ex){
            $message = $ex->getMessage();
        }
        
        $this->set(compact('associado', 'message'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Associado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        try{
            $associado = $this->Associado->get($id);
            if($associado->email != $this->request->getData('email') && !empty($this->Associado->find('all')->where(['email' => $this->request->getData('email')])->first()))
                throw new EmailExceptioin('Este email já está cadastrado em nosso sistema.');
            $associado = $this->Associado->patchEntity($associado, $this->request->getData());
            $message = '';
            $associado->dataNascimento  = new \DateTime($this->request->getData('dataNascimento'));  
            $associado->freelancer = (bool)$this->request->getData('freelancer');

            if($this->Associado->save($associado))
                $message = 'success';
            else
                $message = 'error';

        }catch(RecordNotFoundException $ex){
            $message = $ex->getMessage();
        }catch(MailException $ex){
            $message = $ex->getMessage();
        }catch(Exception $ex){
            $message = $ex->getMessage();
        }
        
        $this->set(compact('associado', 'message'));
    }
    
    public function getByCpf()
    {
        $this->request->allowMethod(['post']);
        $cpf = $this->request->data('CPF');
        $associado = $this->Associado->find('all')->where(['CPF' => $cpf])->first();
        $message = '';
        if(!empty($associado))
            $message = 'success';
        
        $this->set(compact('associado', 'message'));
    }
    
    public function getByEmail()
    {
        $this->request->allowMethod(['post']);
        $email = $this->request->data('email');
        $associado = $this->Associado->find('all')->where(['email' => $email])->first();
        $message = '';
        if(!empty($associado))
            $message = 'success';
        
        $this->set(compact('associado', 'message'));
    }
    
    public function recoverPassword()
    {
        $this->request->allowMethod(['post']);
        $cpf = $_POST['CPF'];
        if($cpf){
            $associado = $this->Associado->find('all')->where(['CPF' => $cpf])->first();
            if(!empty($associado)){
                $password = $this->Funcoes->gerarSenha(5, true, true, true, false);
                $associado->senha = $password;
                if($this->Associado->save($associado)){
                    $status = $this->Funcoes->enviarSenha($associado, $password);
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
                $message = 'CPF não cadastrado no sistema.';
            }
        }
        else{
            $message = 'Informe um CPF válido.';
        }
        
        $this->set(compact('message'));
        $this->set('_serialize', ['message']);
    }
    
    public function aceitarTermo($idAssociado = null)
    {
        $this->request->allowMethod(['get']);
        $message = '';
        if($idAssociado){
            try{
                $associado = $this->Associado->get($idAssociado);
                //$termoAceito = (bool)$_POST['termoAceito'];
                $associado->termoAceito = 1;
                if($this->Associado->save($associado))
                    $message = 'success';
                else
                    $message = 'error';
            }catch(RecordNotFoundException $ex){
                $message = 'error';
            }
        }
        else{
            $message = 'error';
        }
        
        $this->set(compact('message'));
    }
    
    public function setContracheque($idAssociado = null)
    {
        $this->request->allowMethod(['post']);
        $message = '';
        if($idAssociado){
            try{
                $associado = $this->Associado->get($idAssociado);
                $associado->ultContracheque = preg_replace("/\s|\n|\t/", '+', $this->request->getData('contracheque'));
                if($this->Associado->save($associado))
                    $message = 'success';
                else
                    $message = 'error';
            }catch(RecordNotFoundException $ex){
                $message = 'error';
            }
        }
        else{
            $message = 'error';
        }
        $this->set(compact('message'));
    }
    
    public function setDocumento($idAssociado = null)
    {
        $this->request->allowMethod(['post']);
        $message = '';
        if($idAssociado){
            try{
                $associado = $this->Associado->get($idAssociado);
                $associado->fotoDocumento = preg_replace("/\s|\n|\t/", '+', $this->request->getData('documento'));
                if($this->Associado->save($associado))
                    $message = 'success';
                else
                    $message = 'error';
            }catch(RecordNotFoundException $ex){
                $message = 'error';
            }
        }
        else{
            $message = 'error';
        }
        $this->set(compact('message'));
    }
    
    public function setFoto($idAssociado = null)
    {
        $this->request->allowMethod(['post']);
        $message = '';
        if($idAssociado){
            try{
                $associado = $this->Associado->get($idAssociado);
                $associado->foto3x4 = preg_replace("/\s|\n|\t/", '+', $this->request->getData('foto'));
                if($this->Associado->save($associado))
                    $message = 'success';
                else
                    $message = 'error';
            }catch(RecordNotFoundException $ex){
                $message = 'error';
            }
        }
        else{
            $message = 'error';
        }
        $this->set(compact('message'));
    }
    
    public function getCarteirinha($idAssociado = null)
    {
        $this->request->allowMethod(['get']);
        $associado = $this->Associado->get($idAssociado);
        $pdf = new Mpdf(['format' => [85, 53], 'margin_left' => 0, 'margin_right' => 0, 'margin_top' => 0, 'margin_bottom' => 2]);
        $pdf->SetDisplayMode('fullpage');
        $bootstrap = file_get_contents('css/bootstrap.min.css');
        $pdf->WriteHTML($bootstrap, 1);
        $body = '<body style="background-color: green">'
                . '<table style="width:100%">'
                . '<tbody>'
                . '<tr style="background-color: white"><td colspan="2" style="padding-left:5px;">ASSOCIADO AO CLUBE SINGAREHST</td><td style="text-align: right; padding-right:4px"><img src="'.WWW_ROOT.'img'.DS.'logo.png'.'" style="width: 40px"></td></tr>'
                . '<tr><td colspan="3" style="padding-left:15px; padding-top:40px; padding-bottom:50px"><b>'.strtoupper($associado->nome).'</b></td></tr>'
                . '<tr><td style="padding-left:15px;">'.$associado->CPF.'</td><td colspan="2">Validade: '.$associado->vencimentoCarteirinha->i18nFormat('dd/MM/yyyy').'</td></tr>'
                . '</tobdy>'
                . '</table>'
                . '</body>';
        //print_r($body);exit();
        $pdf->WriteHtml($body);
        $pdfName = WWW_ROOT.'img'.DS.'carteirinha'.$associado->nome.'_'.(new \DateTime())->format('d-m-Y').'.pdf';
        $pdf->Output($pdfName, \Mpdf\Output\Destination::FILE);
    }
}
