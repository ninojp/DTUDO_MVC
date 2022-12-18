<?php
namespace App\adms\Models;

class AdmsAddStisUsers
{
    private array|string|null $data;

    private bool $result;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** =============================================================================================
     * @return void     */
    private function addSitsUsers():void
    {
        //usa a função:date() para receber a data e hora atual e atribui para o atributo:$this->data na posição:['created']
        $this->data['created'] = date('Y-m-d H:i:s');

        $addSitsUsers = new \App\adms\Models\helper\AdmsCreate();
        $addSitsUsers->exeCreate("adms_sits_users", $this->data);
        //Usa o objeto para instânciar o método:getResult(), e verificar, se o método retornou true, adicionou com sucesso
        if($addSitsUsers->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Situação cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Situação não cadastrado com sucesso</p>";
            $this->result = false;
        }

    }

}