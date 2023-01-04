<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Alterar a ordem do Nivel de acesso */
class AdmsOrderAccessNivels

{
    private bool $result;
    private array|null $resultBd;
    private array|null $resultBdPrev;
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
            var_dump($this->resultBd);
            $this->viewPrevAccessNivels();
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nivel de Acesso não encontrada!</p>";
            $this->result = false;
        }
    }
    private function viewPrevAccessNivels():void
    {
        $prevAccessNivels = new \App\adms\Models\helper\AdmsRead();
        $prevAccessNivels->fullRead("SELECT id, order_levels FROM adms_access_levels WHERE order_levels <:order_levels AND order_levels >:order_levels_user ORDER BY order_levels DESC LIMIT :limit", "order_levels={$this->resultBd[0]['order_levels']}&order_levels_user=".$_SESSION['order_levels']."&limit=1");

        $this->resultBdPrev = $prevAccessNivels->getResult();
        if($this->resultBdPrev){
            var_dump($this->resultBdPrev);
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nivel de Acesso não encontrada!</p>";
            $this->result = false;
        }
    }
}
