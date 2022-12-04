<?php

namespace App\adms\Models;


/** Classe:AdmsListUsers, deve receber os dados(do DB) dos usuários para listar */
class AdmsListUsers
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;
    /** @var array - Recebe os dados(registros) do Banco de dados    */
    private array|null $resultBd;

    /** ============================================================================================
     * Retorna true quando executar o processo com sucesso e false quando houver erro
     * @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os registros(usuários) do DB 
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function listUsers():void
    {
        $listUsers = new \App\adms\Models\helper\AdmsRead();
        $listUsers->fullRead("SELECT id, name, email FROM adms_users ORDER BY id DESC");

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
