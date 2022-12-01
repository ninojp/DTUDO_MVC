<?php

namespace App\adms\Models;

/** Confirmar a chave atualizar senha. Cadastrar nova senha */
class AdmsUpdatePassword
{
    /** @var string - Recebe da URL a chave para atualizar a senha  */
    private string $key;
    /** @var boolean - Recebe do método:getResult() o valor:(true or false), q será atribuido aqui */
    private bool $result;
    /** @var array - Recebe os dados do conteúdo do e-mail  */
    private array $resultBd;
    /** @var array - Recebe os valores q devem ser salvos no banco de dados  */
    private array $dataSave;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result o valor true ou false
     * @return void  */
    function getResult()
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @param array|null $data
     * @return void    */
    // este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
    public function valKey(string $key): void
    {
        $this->key = $key;
        // var_dump($this->key);
        $viewKeyUpPass = new \App\adms\Models\helper\AdmsRead();
        $viewKeyUpPass->fullRead("SELECT id FROM adms_users WHERE recover_password=:recover_password LIMIT :limit", "recover_password={$this->key}&limit=1");
        $this->resultBd = $viewKeyUpPass->getResult();
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Link inválido, Solicite um novo Link <a href='".URLADM."recover-password/index'>Clique aqui</a></p>";
            $this->result = false;
        }
    }
}
