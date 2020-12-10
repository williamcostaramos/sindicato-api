<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\NotFoundException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class FuncoesComponent extends Component{
    
    public function gerarSenha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos)
    {
        $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
        $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
        $nu = "0123456789"; // $nu contem os números
        $si = "!@#$%¨&*()_+="; // $si contem os símbolos
        $senha = '';

        if ($maiusculas){
            // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($ma);
        }

        if ($minusculas){
            // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($mi);
        }

        if ($numeros){
            // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($nu);
        }

        if ($simbolos){
            // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
            $senha .= str_shuffle($si);
        }

        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }
    
    public function enviarSenha($usuario, $senha)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'cadastrosingarehst@gmail.com';                 // SMTP username
            $mail->Password = 'singa2019';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('cadastrosingarehst@gmail.com', 'Singarehst');
            $mail->addAddress($usuario->email, $usuario->nome);     // Add a recipient
//            $mail->addAddress('ellen@example.com');               // Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            //Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(false); 
            $mail->CharSet = 'utf-8';			// Set email format to HTML
            $mail->Subject = 'Recuperação de senha';
            $mail->Body    = 'Nova senha:'. $senha;
            //$mail->AltBody = $nome.' - Caso não consiga visualiar esta mensagem corretamente você pode imprimir seu voucher em nosso sistema';
//print_r($mail);exit();
            $mail->send();print_r($mail);exit();
            return 'success';
        } catch (Exception $e) {print_r($e);exit('ex');
            return 'Falha ao enviar email: '. $mail->ErrorInfo;
        }
    }

}