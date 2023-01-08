<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Alterar a ordem do Nivel de acesso */
class AdmsOrderGroupsPgs

{
    private bool $result;
    private array|null $resultBd;
    private array|null $resultBdPrev;
    private int|string|null $id;
    private $data;

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
     * Recebe como parametro o id, através do mesmo verifica o nivel de acesso atual:order_levels, se for maior, o coloca no atributo:$resultBd para instanciar o método:viewPrevAccessNivels()
     * @param integer $id -  @return void      */
    public function orderGroupsPgs(int $id): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id = (int) $id;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $atualGroupsPgs = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $atualGroupsPgs->fullRead("SELECT id, order_group_pg FROM adms_groups_pgs WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $atualGroupsPgs->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->viewPrevGroupsPgs();
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Grupo de Páginas não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método para recuper a Ordem de acesso do nivel  superior(nivel acima do atual)
     * @return void     */
    private function viewPrevGroupsPgs():void
    {
        $prevGroupsPgs = new \App\adms\Models\helper\AdmsRead();
        $prevGroupsPgs->fullRead("SELECT id, order_group_pg FROM adms_groups_pgs WHERE order_group_pg <:order_group_pg ORDER BY order_group_pg DESC LIMIT :limit", "order_group_pg={$this->resultBd[0]['order_group_pg']}&limit=1");

        $this->resultBdPrev = $prevGroupsPgs->getResult();
        if($this->resultBdPrev){
            // var_dump($this->resultBdPrev);
            $this->editMoveDown();
            // $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Grupo de páginas não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editMoveDown(): void
    {
        $this->data['order_group_pg'] = $this->resultBd[0]['order_group_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_groups_pgs", $this->data, "WHERE id=:id", "id={$this->resultBdPrev[0]['id']}");

        if($moveDown->getResult()){
            $this->result = true;
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Ordem do Grupos de páginas editado com sucesso!</p>";
            $this->result = false;
        }
    }
    private function editMoveUp():void
    {
        $this->data['order_group_pg'] = $this->resultBdPrev[0]['order_group_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveUp = new \App\adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_groups_pgs", $this->data, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if($moveUp->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Ordem do Grupo de páginas editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Ordem do Grupo de páginas Não editado com sucesso!</p>";
            $this->result = false;
        }

    }
}
