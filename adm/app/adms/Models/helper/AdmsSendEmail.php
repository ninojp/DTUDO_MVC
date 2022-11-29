<?php

namespace App\adms\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/** Classe genérica para Enviar um E-mail */
class AdmsSendEmail
{
    /** @var array - Recebe as informações do conteúdo do e-mail     */
    private array $data;
    // Atributo q recebe o resultado da query ao DB, table adms_confs_emails
    private $resultBd;
    /** @var array - Receber as credenciais do e-mail    */
    private array $dataInfoEmail;
    /** @var boolean Retorna true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;
    /** @var string - Recebe o e-mail do remetente    */
    private string $fromEmail = EMAILADM;
    /** @var integer - Recebe o id do email q será utilizado para enviar o e-mail     */
    private int $optionConfEmail;

    /** ==============================================================================================
     * Este método serve para obter o resultado(true, false) dos métodos dentro da classe
     * @return boolean     */
    function getResult(): bool
    {
        return $this->result;
    }
    /** ============================================================================================
     *  @return string - Retorna o e-mail do Remetente     */
    function getFromEmail():string
    {
        return $this->fromEmail;
    }

    /** =============================================================================================
     * servidor para enviar e=mail /fake: https://mailtrap.io/signin 
     * @return void
     */
    public function sendEmail(array $data, int $optionConfEmail):void
    {
        //atribui para o atributo:$this->optionConfEmail, o id recebido como parametro
        $this->optionConfEmail = $optionConfEmail;
        $this->data = $data;

        // //será enviado para o e-mail...(fake, no caso, MailTrap)
        // $this->data['toEmail'] = "meuemailparablog@gmail.com";
        // //Quem vai receber
        // $this->data['toName'] = "Edenilson";
        // //Assunto do email
        // $this->data['subject'] = "Confirmar o e-mail cadastro";
        // //conteúdo do e-mail, em HTML
        // $this->data['contentHtml'] = "Olá <b>Edenilson</b><br><p>Cadastro realizado com sucesso!</p>";
        // //conteúdo do e-mail, formato texto
        // $this->data['contentText'] = "Olá Edenilson \n\nCadastro realizado com sucesso!";

        //Instancio o método para enviar o email
        $this->infoPhpMailer();
    }
    /** ==========================================================================================
     * Método para buscar infomações na tabela:adms_confs_emails, para utilizar no envio do e-mail
     * @return void    */
    private function infoPhpMailer():void
    {
       $confEmail = new \App\adms\Models\helper\AdmsRead();
       $confEmail->fullRead("SELECT name, email, host, username, password, smtpsecure, port FROM adms_confs_emails WHERE id =:id LIMIT :limit", "id={$this->optionConfEmail}&limit=1");
       $this->resultBd = $confEmail->getResult();
       if($this->resultBd){
            // var_dump($this->resultBd);
            $this->dataInfoEmail['host'] = $this->resultBd[0]['host'];
            $this->dataInfoEmail['fromEmail'] = $this->resultBd[0]['email'];
            $this->fromEmail = $this->dataInfoEmail['fromEmail'];
            $this->dataInfoEmail['fromName'] = $this->resultBd[0]['name'];
            $this->dataInfoEmail['username'] = $this->resultBd[0]['username'];
            $this->dataInfoEmail['password'] = $this->resultBd[0]['password'];
            $this->dataInfoEmail['smtpsecure'] = $this->resultBd[0]['smtpsecure'];
            //em alguns casos(PHPMailers) a porta é 587 - (2525, do site MailTrap)
            $this->dataInfoEmail['port'] = $this->resultBd[0]['port'];

            $this->sendEmailPhpMailer();
        }else{
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! !<p>";
            $this->result = false;
        }
    }
    /** =========================================================================================
     * @return void    */
    private function sendEmailPhpMailer(): void
    {
        //Instancia a classe:PHPMailer e cria o objeto:$mail, passando `true` para abilitar as (exceptions) - \vendor\phpmailer\phpmailer\src\PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings - SMTPDebug, serve para apresentar os DETALHES do envio do e-mail
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;       //Enable verbose debug output
            $mail->CharSet = 'UTF-8';             //indicar q será utilizado caracteres comacentuação
            $mail->isSMTP();                                   //Send using SMTP
            $mail->Host = $this->dataInfoEmail['host'];        //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                //Enable SMTP authentication
            $mail->Username   = $this->dataInfoEmail['username'];    //SMTP username
            $mail->Password   = $this->dataInfoEmail['password'];    //SMTP password
            //neste caso, site https://mailtrap.io
            $mail->SMTPSecure = $this->dataInfoEmail['smtpsecure'];
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable implicit TLS encryption
            //TCP port to connect to; use 587 if you have set `SMTPSecure = HPMailer::ENCRYPTION_STARTTLS`
            // $mail->Port = 465;                                    
            $mail->Port = $this->dataInfoEmail['port'];

            //Recipients - quem está enviando e quem está recebendo
            $mail->setFrom($this->dataInfoEmail['fromEmail'], $this->dataInfoEmail['fromName']);
            $mail->addAddress($this->data['toEmail'], $this->data['toName']);     //Add a recipient

            //Content - Assunto e conteúdo do e-mail
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->data['subject'];
            $mail->Body    = $this->data['contentHtml'];
            $mail->AltBody = $this->data['contentText'];

            //usando o objeto:$mail para instanciar o método:send() para enviar o e-mail
            $mail->send();
            //caso o e-mail seja enviado com sucesso retorna true
            $this->result = true;
        } catch (Exception $e) {
            $this->result = false;
        }
    }
}
