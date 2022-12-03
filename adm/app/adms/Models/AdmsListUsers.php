<?php

namespace App\adms\Models;


/** Classe:AdmsListUsers, deve receber os dados dos usuários para listar */
class AdmsListUsers
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result
     * @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result
     * @return void     */
    function getResultBd():array|bool
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function listUsers():void
    {
        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT id, name, email FROM adms_users");

        $this->resultBd = $listUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nenhum usuário encontrado!<p>";
            $this->result = false;
        }
    }
}
