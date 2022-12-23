<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para vizualizar os detalhes da situação atual do usuário  */
class AdmsViewSitsUsers
{
    private bool $result;
    private array|null $resultBd;
    private int|string|null $id;

    /** ==========================================================================================
     * @return boolean         */
    public function getResult(): bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * @return array|null         */
    public function getResultBd(): array|null
    {
        return $this->resultBd;
    }
    /** ==========================================================================================
     * @param integer $id -  @return void      */
    public function viewSitsUsers(int $id): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id = $id;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewSitUser = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewSitUser->fullRead("SELECT sits.id, sits.name AS sitsname, sits.created, sits.modified, col.name AS colname, col.color FROM adms_sits_users AS sits INNER JOIN adms_colors AS col ON col.id=sits.adms_color_id WHERE sits.id=:id LIMIT :limit", "id={$this->id}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        //ESTE VAR_DUMP MOSTRA TUDO INCLUSIVE OS DADOS DE CONEXAO COM O DB (SENHA)
        // var_dump($viewSitUser); ME PARECE UMA FALHA DE SEGURANÇA

        $this->resultBd = $viewSitUser->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Situação não encontrada!</p>";
            $this->result = false;
        }
    }
}
