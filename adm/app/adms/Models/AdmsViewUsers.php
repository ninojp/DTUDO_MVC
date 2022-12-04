<?php

namespace App\adms\Models;


/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewUsers
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result
     * @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|bool
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function viewUsers(int $id):void
    {
        $this->id = $id;

        $viewUsers = new \App\adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT id, name, nickname, email, user, image, adms_sits_user_id, created, modified FROM adms_users WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Usuário não encontrado!<p>";
            $this->result = false;
        }
    }
}
