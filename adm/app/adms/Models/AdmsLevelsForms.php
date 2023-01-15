<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Vizualizar os detalhes do registro Cor*/
class AdmsLevelsForms
{
    private bool $result = false;
    private array|null $resultBd;
    // private int|string|null $id;

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
    public function viewLevelsForms(): void
    {
        // echo "Carregou a Models!<br>";
        // $this->result = true;
        // $this->resultBd = [];
        //atribui o id recebido como parametro no atributo:$this->id
        // $this->id = (int) $id;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewLevelsForms = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewLevelsForms->fullRead("SELECT alf.id, alf.adms_access_level_id, alf.adms_sits_user_id, alf.created, alf.modified, aal.name AS name_aal, asu.name AS name_asu
        FROM adms_levels_forms AS alf 
        INNER JOIN adms_access_levels AS aal ON aal.id=alf.adms_access_level_id
        INNER JOIN adms_sits_users AS asu ON asu.id=adms_sits_user_id");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $viewLevelsForms->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro (viewLevelsForms())! Registro:adms_levels_forms, não encontrado!</p>";
            $this->result = false;
        }
    }
}
