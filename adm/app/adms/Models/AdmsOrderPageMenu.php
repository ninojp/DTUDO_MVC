<?php
namespace App\adms\Models;
if (!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')) {
    header("Location: https://localhost/dtudo/public/");
}
/** Classe(Models) para Alterar a ordem do Item de menu */
class AdmsOrderPageMenu
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
    public function orderPageMenu(int $id): void
    {
        //atribui o id recebido como parametro no atributo:$this->id
        $this->id = (int) $id;
        //instância a classe:AdmsRead() e cria o objeto:$viewSitsUsers
        $viewPageMenu = new \App\adms\Models\helper\AdmsRead();
        //usa o objeto para instânciar o método:fullRead(), passando a query desejada
        $viewPageMenu->fullRead("SELECT lev_pag.id, lev_pag.order_level_page, lev_pag.adms_access_level_id FROM adms_levels_pages AS lev_pag
        INNER JOIN adms_access_levels AS lev ON lev.id=lev_pag.adms_access_level_id
        LEFT JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id
        WHERE lev_pag.id=:id AND lev.order_levels >=:order_levels
        AND (((SELECT permission FROM adms_levels_pages WHERE adms_page_id =lev_pag.adms_page_id 
        AND adms_access_level_id ={$_SESSION['access_level_id']})=1) OR (publish=1)) LIMIT :limit",
        "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");
        //usa o objeto para instânciar o método:getResult() e atribui o seu valor no atributo:$this->resultBd

        $this->resultBd = $viewPageMenu->getResult();
        //verifica se atributo:$this->resultBd é true, se for atribui o true para o atributo:$this->result
        if ($this->resultBd) {
            // var_dump($this->resultBd);
            $this->viewPrevPageMenu();
            //se o atributo:$this->resultBd é false, atribui a frase na constante:$_SESSION['msg']
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (orderPageMenu())! Item de Menu não encontrada!</p>";
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método para recuper a Ordem do item de Menu superior(nivel acima do atual)
     * @return void     */
    private function viewPrevPageMenu():void
    {
        $prevPageMenu = new \App\adms\Models\helper\AdmsRead();
        $prevPageMenu->fullRead("SELECT lev_pag.id, lev_pag.order_level_page
        FROM adms_levels_pages AS lev_pag
        LEFT JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id
        WHERE lev_pag.order_level_page <:order_level_page
        AND lev_pag.adms_access_level_id =:adms_access_level_id
        AND (((SELECT permission FROM adms_levels_pages WHERE adms_page_id =lev_pag.adms_page_id 
        AND adms_access_level_id ={$_SESSION['access_level_id']}) = 1) OR (publish = 1))
        ORDER BY lev_pag.order_level_page DESC LIMIT :limit",
        "order_level_page={$this->resultBd[0]['order_level_page']}&adms_access_level_id={$this->resultBd[0]['adms_access_level_id']}&limit=1");

        $this->resultBdPrev = $prevPageMenu->getResult();
        if($this->resultBdPrev){
            // var_dump($this->resultBdPrev);
            $this->editMoveDown();
            // $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewPrevPageMenu())! Item de menu não encontrada!</p>";
            $this->result = false;
        }
    }
    /** ---------------------------------------------------------------------------------------------
     * Método para alterar a ordem do item de menu superior para o inferior
     * @return void     */
    private function editMoveDown(): void
    {
        $this->data['order_level_page'] = $this->resultBd[0]['order_level_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->resultBdPrev[0]['id']}");

        if($moveDown->getResult()){
            $this->result = true;
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editMoveDown())! Ordem do Item de Menu não editado com sucesso!</p>";
            $this->result = false;
        }
    }
    /** --------------------------------------------------------------------------------------------
     * Método para alterar a ordem do item de Menu inferior para o superior
     * @return void     */
    private function editMoveUp():void
    {
        $this->data['order_level_page'] = $this->resultBdPrev[0]['order_level_page'];
        $this->data['modified'] = date("Y-m-d H:i:s");
        // var_dump($this->data);

        $moveUp = new \App\adms\Models\helper\AdmsUpdate();
        $moveUp->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->resultBd[0]['id']}");

        if($moveUp->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Ordem do Item de Menu editado com sucesso!</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editMoveUp())! Ordem do Item de Menu Não editado com sucesso!</p>";
            $this->result = false;
        }

    }
}
