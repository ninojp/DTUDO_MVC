<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Alterar a ordem do Tipo de pagina */
class AdmsOrderTypesPgs

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
     * Recebe como parametro o id, através do mesmo verifica o nivel de acesso atual:order_type_pg, se for maior, o coloca no atributo:$resultBd para instanciar o método:viewPrevTypePg()
     * @param integer $id -  @return void      */
    public function orderTypesPgs(int $id): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id = (int) $id;
        //instância a classe:AdmsRead() e cria o objeto:$atualTypesPgs
        $atualTypesPgs = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $atualTypesPgs->fullRead("SELECT id, order_type_pg FROM adms_types_pgs WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $atualTypesPgs->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->viewPrevOrderTypePg();
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Tipo de Página não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método para recuper a Ordem de acesso do nivel  superior(nivel acima do atual)
     * @return void     */
    private function viewPrevOrderTypePg():void
    {
        $prevOrderType = new \App\adms\Models\helper\AdmsRead();
        $prevOrderType->fullRead("SELECT id, order_type_pg FROM adms_types_pgs WHERE order_type_pg <:order_type_pg ORDER BY order_type_pg DESC LIMIT :limit", "order_type_pg={$this->resultBd[0]['order_type_pg']}&limit=1");

        $this->resultBdPrev = $prevOrderType->getResult();
        if($this->resultBdPrev){
            // var_dump($this->resultBdPrev);
            $this->editMoveDown();
            // $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Tipo de página não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editMoveDown(): void
    {
        $this->data['order_type_pg'] = $this->resultBd[0]['order_type_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_types_pgs", $this->data, "WHERE id=:id", "id={$this->resultBdPrev[0]['id']}");

        if($moveDown->getResult()){
            $this->result = true;
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Ordem do Nivel de Acesso editado com sucesso!</p>";
            $this->result = false;
        }
    }
    /** ============================================================================================
     * @return void     */
    private function editMoveUp():void
    {
        $this->data['order_type_pg'] = $this->resultBdPrev[0]['order_type_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveUp = new \App\adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_types_pgs", $this->data, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if($moveUp->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Ordem do tipo de página editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Ordem do tipo de página Não editado com sucesso!</p>";
            $this->result = false;
        }

    }
}
