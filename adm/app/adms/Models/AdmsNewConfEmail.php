<?php

namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;
use App\adms\Models\helper\AdmsRead;
use App\adms\Models\helper\AdmsSendEmail;
use PDO;


/** Solicitar novo link confirmar o e-mail */
class AdmsNewConfEmail extends AdmsConn
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;
    /** @var boolean - Recebe do método:getResult() o valor:(true or false), q será atribuido aqui */
    private bool $result;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array $resultBd;
    /** @var string - Recebe o primeiro nome(digitado) do usuário    */
    private string $firstName;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array $emailData;

    private array $dataSave;

    private string $url;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result o valor true ou false
     * @return void     */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function newConfEmail(array $data = null): void
    {
        $this->data = $data;
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->valField($this->data);
        if($valEmptyField->getResult()){
            $this->valUser();
        }else{
            $this->result = false;
        }
    }
    /** ========================================================================================     * @return void     */
    private function valUser():void
    {
        $newConfEmail = new AdmsRead();
        $newConfEmail->fullRead("SELECT id, name, email, conf_email FROM adms_users WHERE email=:email LIMIT :limit", "email={$this->data['email']}&limit=1");
        $this->resultBd = $newConfEmail->getResult();
        if ($this->resultBd) {
            $this->valConfEmail();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! E-mail não cadastrado!</p>";
            $this->result = false;
        }
    }
    /** ==========================================================================================
     * @return void     */
    private function valConfEmail(): void
    {
        if ((empty($this->resultBd[0]['conf_email'])) or ($this->resultBd[0]['conf_email'] == NULL)) {
            $this->dataSave['conf_email'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);
            $this->dataSave['modified'] = date("Y-m-d H:i:s");
            // $this->dataSave['exemplo1'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);
            // $this->dataSave['exemplo2'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);

            $upNewConfEmail = new \App\adms\Models\helper\AdmsUpdate();
            $upNewConfEmail->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

            if($upNewConfEmail->getResult()){
                $this->resultBd[0]['conf_email'] = $this->dataSave['conf_email'];
                $this->sendEmail();
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Link não enviado, tente novamente!</p>";
                $this->result = false;
            }

            //abaixo está codigo usado antes de criar a MODEL genérica, para fazer os Updates
        //     $query_activate_user = "UPDATE adms_users SET conf_email=:conf_email, modified=NOW() WHERE id=:id LIMIT :limit";
        //     $activate_user = $this->connectDb()->prepare($query_activate_user);
        //     $activate_user->bindParam(':conf_email', $conf_email);
        //     $activate_user->bindParam(':id', $this->resultBd[0]['id']);
        //     $activate_user->bindValue(':limit', 1, PDO::PARAM_INT);
        //     $activate_user->execute();

        //     if ($activate_user->rowCount()) {
        //         $this->resultBd[0]['conf_email'] = $conf_email;
        //         $this->sendEmail();
        //     } else {
        //         $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Link não enviado, tente novamente!</p>";
        //         $this->result = false;
        //     }
            // $this->result = false;
        } else {
            // echo "Possui valor na coluna 'conf_email'<br>";
            $this->sendEmail();
            // $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return void     */
    private function sendEmail(): void
    {
        $sendEmail = new AdmsSendEmail();
        $this->emailHtml();
        $this->emailText();
        $sendEmail->sendEmail($this->emailData, 2);
        if ($sendEmail->getResult()) {
            $_SESSION['msg'] = "<p class='alert alert-success'>OK! Novo Link enviado com sucesso, acesse sua caixa de e-mail para confirmar o e-mail!</p>";
            $this->result = true;
        } else {
            //instancia o método:getFromEmail(), para receber o email de quem está enviando
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Link não enviado,tente novamente ou entre em contado com o e-mail {$this->fromEmail}</p>";
            $this->result = false;
        }
    }
    /** ==========================================================================================
     *
     * @return void     */
    private function emailHtml(): void
    {
        $name = explode(" ", $this->resultBd[0]['name']);
        $this->firstName = $name[0];

        $this->emailData['toEmail'] = $this->data['email'];
        $this->emailData['toName'] = $this->resultBd[0]['name'];
        $this->emailData['subject'] = "Confirme seu E-mail!";
        $this->url = URLADM . "conf-email/index?key=" . $this->resultBd[0]['conf_email'];

        $this->emailData['contentHtml'] = "Prezado Sr(a) {$this->firstName}.<br><br>";
        $this->emailData['contentHtml'] .= "Agradecemos sua solicitação de cadastro em nosso site!.<br><br>";
        $this->emailData['contentHtml'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicando no link abaixo:<br><br>";
        $this->emailData['contentHtml'] .= "<a href='{$this->url}'>{$this->url}</a><br><br>";
        $this->emailData['contentHtml'] .= "Esta menssagem foi enviado a você pela empresa XXX.<br>Você nunca recebera nenhum e-mail solicitando qualquer informações cadastrais...<br><br>";
    }
    /** ==========================================================================================
     *
     * @return void     */
    private function emailText(): void
    {
        $this->emailData['contentText'] = "Prezado Sr(a) {$this->firstName}.\n\n";
        $this->emailData['contentText'] .= "Agradecemos sua solicitação de cadastro em nosso site!\n\n";
        $this->emailData['contentText'] .= "Para que possamos liberar seu cadastro em nosso sistema, solicitamos a confirmação do e-mail. COPIE e COLE o endereço abaixo, na barra de endereço do seu navegador de internet.\n\n";
        $this->emailData['contentText'] .= $this->url . "\n\n ";
        $this->emailData['contentText'] .= "Esta menssagem foi enviado a você pela empresa XXX.\n Você nunca recebera nenhum e-mail solicitando qualquer informações cadastrais...\n\n";
    }
}
