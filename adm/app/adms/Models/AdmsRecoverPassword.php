<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use App\adms\Models\helper\AdmsRead;
use App\adms\Models\helper\AdmsSendEmail;
use App\adms\Models\helper\AdmsValEmptyField;
/** Solicitar novo link para cadastrar uma nova senha */
class AdmsRecoverPassword
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
    public function recoverPassword(array $data = null): void
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
        $newConfEmail->fullRead("SELECT id, name, email FROM adms_users WHERE email=:email LIMIT :limit", "email={$this->data['email']}&limit=1");
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
            $this->dataSave['recover_password'] = password_hash(date("Y-m-d H:i:s") . $this->resultBd[0]['id'], PASSWORD_DEFAULT);
            $this->dataSave['modified'] = date("Y-m-d H:i:s");

            $upNewConfEmail = new \App\adms\Models\helper\AdmsUpdate();
            $upNewConfEmail->exeUpdate("adms_users", $this->dataSave, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

            if($upNewConfEmail->getResult()){
                $this->resultBd[0]['recover_password'] = $this->dataSave['recover_password'];
                $this->sendEmail();
            }else{
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Link não enviado, tente novamente!</p>";
                $this->result = false;
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
            $_SESSION['msg'] = "<p class='alert alert-success'>OK! Enviado e-mail com as instruções para recuperar sua senha. Acesse a sua caixa de e-mail para recuperar a senha!</p>";
            $this->result = true;
        } else {
            //instancia o método:getFromEmail(), para receber o email de quem está enviando
            $this->fromEmail = $sendEmail->getFromEmail();
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! E-mail com as instruções para recuperar a senha não enviado, tente novamente ou entre em contado com o e-mail {$this->fromEmail}</p>";
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
        $this->emailData['subject'] = "Recuperar sua senha!";
        $this->url = URLADM . "update-password/index?key=" . $this->resultBd[0]['recover_password'];

        $this->emailData['contentHtml'] = "Prezado Sr(a) {$this->firstName}.<br><br>";
        $this->emailData['contentHtml'] .= "Você Solicitou a alteração de sua senha!.<br><br>";
        $this->emailData['contentHtml'] .= "Para continuar o processo de recuperação de sua senha, Clique no Link abaixo ou copie e cole o mesmo na barra de endereço de seu navegador<br><br>";
        $this->emailData['contentHtml'] .= "<a href='".$this->url."'>".$this->url."</a><br><br>";
        $this->emailData['contentHtml'] .= "Se você não solicitou essa alteração, nenhuma ação é necessára. Sua senha permanecerá a mesma até que você ative este codigo<br><br>";
    }
    /** ==========================================================================================
     *
     * @return void     */
    private function emailText(): void
    {
        $this->emailData['contentText'] = "Prezado Sr(a) {$this->firstName}.\n\n";
        $this->emailData['contentText'] .= "Você Solicitou a alteração de sua senha!.\n\n";
        $this->emailData['contentText'] .= "Para continuar o processo de recuperação de sua senha, Clique no Link abaixo ou copie e cole o mesmo na barra de endereço de seu navegador.\n\n";
        $this->emailData['contentText'] .= $this->url . "\n\n ";
        $this->emailData['contentText'] .= "Se você não solicitou essa alteração, nenhuma ação é necessára. Sua senha permanecerá a mesma até que você ative este codigo.\n\n";
    }
}
