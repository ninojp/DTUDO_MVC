<?php
namespace App\adms\Models;

/** Classe:AdmsDeleteUsers, Apagar o usuário no banco de dados */
class AdmsDeleteUsers
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     *  @return void      */
    public function deleteUsers(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        $deleteUser = new \App\adms\Models\helper\AdmsDelete();
        $deleteUser->exeDelete("adms_users", "WHERE id =:id", "id={$this->id}");

        if($deleteUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-danger'>OK! Usuário APAGADO com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Usuário Não APAGADO com sucesso!!</p>";
            $this->result = false;
        }
    }
}
