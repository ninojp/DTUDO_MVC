<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Alterar a ordem do Nivel de acesso */
class AdmsOrderAccessNivels

{
    /** @var boolean - Recebe true ou false     */
    private bool $result;

    /** @var array|null - Recebe os registros do DB    */
    private array|null $resultBd;

    /** @var array|null - Rcebe os registros do DB     */
    private array|null $resultBdPrev;

    /** @var integer|string|null - Rcebe o id do registro     */
    private int|string|null $id;

    /** @var array|null - Recebe as novas posições e as atribui para o array - Eu que criei, na aula o prof não o fez     */
    private array|null $data;

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
    public function orderAccessNivels(int $id): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id = (int) $id;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $atualAccessNivels = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $atualAccessNivels->fullRead("SELECT id, order_levels FROM adms_access_levels WHERE id=:id AND order_levels > :order_levels LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $atualAccessNivels->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->viewPrevAccessNivels();
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nivel de Acesso não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método para recuper a Ordem de acesso do nivel  superior(nivel acima do atual)
     * @return void     */
    private function viewPrevAccessNivels():void
    {
        $prevAccessNivels = new \App\adms\Models\helper\AdmsRead();
        $prevAccessNivels->fullRead("SELECT id, order_levels FROM adms_access_levels WHERE order_levels <:order_levels AND order_levels >:order_levels_user ORDER BY order_levels DESC LIMIT :limit", "order_levels={$this->resultBd[0]['order_levels']}&order_levels_user=".$_SESSION['order_levels']."&limit=1");

        $this->resultBdPrev = $prevAccessNivels->getResult();
        if($this->resultBdPrev){
            // var_dump($this->resultBdPrev);
            $this->editMoveDown();
            // $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewPrevAccessNivels())! Nivel de Acesso não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editMoveDown(): void
    {
        $this->data['order_levels'] = $this->resultBd[0]['order_levels'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_access_levels", $this->data, "WHERE id=:id", "id={$this->resultBdPrev[0]['id']}");

        if($moveDown->getResult()){
            $this->result = true;
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editMoveDown())! Ordem do Nivel de Acesso não editado com sucesso!</p>";
            $this->result = false;
        }
    }
    private function editMoveUp():void
    {
        $this->data['order_levels'] = $this->resultBdPrev[0]['order_levels'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveUp = new \App\adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_access_levels", $this->data, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if($moveUp->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Ordem do Nivel de Acesso editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editMoveUp())! Ordem do Nivel de Acesso Não editado com sucesso!</p>";
            $this->result = false;
        }

    }
}
