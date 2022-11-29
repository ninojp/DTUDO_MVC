<?php

namespace App\adms\Models;

use App\adms\Models\helper\AdmsConn;
use App\adms\Models\helper\AdmsRead;
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

        $newConfEmail = new AdmsRead();
        $newConfEmail->fullRead("SELECT id, name, email, conf_email FROM adms_users WHERE email=:email LIMIT :limit", "email={$this->data['email']}&limit=1");
        $this->resultBd = $newConfEmail->getResult();
        if ($this->resultBd){
            $this->valConfEmail();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! E-mail não cadastrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function valConfEmail():void
    {
        if((empty($this->resultBd[0]['conf_email'])) or ($this->resultBd[0]['conf_email'] == NULL)){
            echo "Possui valor na coluna 'conf_email'<br>";
            $this->result = false;  
        }else{
            echo "Possui valor na coluna 'conf_email'<br>";
            $this->result = false;
        }
    }
}
