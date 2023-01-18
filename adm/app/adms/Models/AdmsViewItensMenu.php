<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para vizualizar os detalhes da situação atual do usuário  */
class AdmsViewItensMenu
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
    public function viewItensMenu(int $id): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id = $id;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewItensMenu = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewItensMenu->fullRead("SELECT id, name, icon, order_item_menu, created, modified FROM adms_items_menus WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $viewItensMenu->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->result = true;
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewItensMenu())! Item de Menu não encontrada!</p>";
            $this->result = false;
        }
    }
}
