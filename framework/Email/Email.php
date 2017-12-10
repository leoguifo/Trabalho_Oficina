<?php 

namespace Framework\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Framework\View\View;

class Email {
    private $mail;

    public function __construct(){
        $this->mail = new PHPMailer(true);
    }

    public function para($email, $nome = null){
        if($nome == null){
            $this->mail->AddAddress($email);
        } else {
            $this->mail->AddAddress($email, $nome);
        }

        return $this;
    }

    public function assunto($assunto){
        $this->mail->Subject = $assunto;

        return $this;
    }

    public function conteudo($conteudo){
        $this->mail->Body = $conteudo;

        return $this;
    }

    public function conteudoView($view, $args){
        $this->mail->Body = View::make($view, $args);

        return $this;
    }

    public function enviar(){
        include($_SERVER['DOCUMENT_ROOT'] . "\\config\\Email.php");

        $this->mail->Host = $email['host'];
        $this->mail->Username = $email['usuario'];
        $this->mail->Password = $email['senha'];
        $this->mail->SMTPAuth = true;
        $this->mail->isHTML(true);
        $this->mail->CharSet = 'utf-8';
        $this->mail->setLanguage('br');
        $this->mail->setFrom($email['usuario'], $email['nome']);
        
        try{
            $this->mail->send();
        } catch (Exception $e){
            echo $this->mail->ErrorInfo;
        }
    }
}