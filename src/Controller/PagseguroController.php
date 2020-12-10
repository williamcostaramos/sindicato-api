<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class PagseguroController extends AppController
{   
    
    public function beforeRender(Event $event) {
        parent::beforeRender($event);
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['transaction']);
        $this->viewBuilder()->layout('ajax');
    }
    
    public function getSessionId(){
        $this->request->allowMethod('post');
        
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions';
        $data = ['email' => 'jansley06@gmail.com', 'token' => '2E2F4901F30A43A49E53E2B1D447644C'];
        $content = http_build_query($data);

        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',                    
                'header' => "Connection: close\r\n".
                            "Content-type: application/x-www-form-urlencoded\r\n".
                            "Content-Length: ".strlen($content)."\r\n",
                'content' => $content                               
            )
        ));
        // Realiza comunicação com o servidor
        $resposta = file_get_contents($url, null, $context); 
        $resposta = simplexml_load_string($resposta);
        $this->set(compact('resposta'));
        
    }
    
    public function pagamento(){
        $this->request->allowMethod('post');
        
        $this->loadModel('AppConfiguracoes');
        $this->loadModel('EmpresaPagamentos');
        $valor = number_format($this->AppConfiguracoes->find('all')->first()->valorTaxa, 2, '.', '.');
        $cpf = preg_replace('/\D/', '', $this->request->data['cardHolderCPF']);
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions';
        $data = ['email' => 'jansley06@gmail.com', 
                'token' => '2E2F4901F30A43A49E53E2B1D447644C',
                'paymentMode' => 'default',
                'paymentMethod' => 'creditCard',
                'receiverEmail' => 'jansley06@gmail.com',
                'currency' => 'BRL',
                'itemId1' => $this->request->data['associadoId'],
                'itemDescription1' => 'App Singarehst',
                'itemAmount1' => $valor,
                'itemQuantity1' => '1',
                'reference' => 'REF1234',
                'senderName' => $this->request->data['cardHolderName'],
                'senderEmail' => $this->request->data['email'],
                'senderHash' => $this->request->data['senderHash'],
                'creditCardToken' => $this->request->data['creditCardToken'],
                'shippingAddressRequired' => 'false',
                'senderAreaCode' => '63',
                'senderPhone' => '99999999',
                'senderCPF' => $cpf,
                'billingAddressNumber' => '9',
                'billingAddressPostalCode' => '77000001',
                'installmentValue' => $valor,
                'creditCardHolderName' => $this->request->data['cardHolderName'],
                'creditCardHolderCPF' => $cpf,
                'installmentQuantity' => '1',
                'billingAddressState' => 'TO',
                'billingAddressDistrict' => 'Plano Diretor Norte',
                'billingAddressCountry' => 'BR',
                'billingAddressCity' => 'Palmas',
                'billingAddressStreet' => '504 Norte'];

        $data = http_build_query($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $resposta = curl_exec($ch); 
        $http = curl_getinfo($ch);
        $resposta = simplexml_load_string($resposta);
        $resposta = json_encode($resposta);
        $resposta = json_decode($resposta);

        if(!empty($resposta->code)){
            $pagamento = $this->EmpresaPagamentos->newEntity();
            $pagamento->codTransacao = $resposta->code;
            $pagamento->dataPagamento = new \DateTime($resposta->date);
            $pagamento->status = $resposta->status;
            $pagamento->valor = $valor;
            $pagamento->empresa_id = $this->request->data('empresaId');
            $pagamento->associado_id = $this->request->data('associadoId');
            $this->EmpresaPagamentos->save($pagamento);
            $message = 'success';
        }
        else{
            $message = 'error';
        }
        
        $this->set(compact('resposta', 'message'));
        
    }
    
    public function transaction()
    {
        $this->request->allowMethod(['get', 'post']);
        $this->loadModel('EmpresaPagamentos');
        $notificationCode = $_POST['notificationCode'];
        $notificationType = $_POST['notificationType'];
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/'.$notificationCode;


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url . "?email=jansley06@gmail.com&token=2E2F4901F30A43A49E53E2B1D447644C");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $xml= curl_exec($curl);
        curl_close($curl);

        $xml= simplexml_load_string($xml);
        $transacao = json_encode($xml);
        $transacao = json_decode($transacao);
        $pagamento = $this->EmpresaPagamentos->find('all')->where(['codTransacao' => $transacao->code])->first();
        if(!empty($pagamento)){
            $pagamento->status = $transacao->status;
            $this->EmpresaPagamentos->save($pagamento);
            die();
        }
        die();
    }
}
