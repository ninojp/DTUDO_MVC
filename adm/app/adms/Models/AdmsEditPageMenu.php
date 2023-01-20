<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Models):AdmsEditPageMenu, para editar a página no Item de menu(sidebar) */
class AdmsEditPageMenu
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;

    private array $listRegistryAdd;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ===========================================================================================
     * Método para visualizar os detalhes da página no Item de menu(sidebar)    */
    public function viewPageMenu(int $id):void
    {
        $this->id = $id;

        $viewPageMenu = new \App\adms\Models\helper\AdmsRead();
        $viewPageMenu->fullRead("SELECT lev_pag.id, lev_pag.adms_items_menu_id, pag.name_page
        FROM adms_levels_pages AS lev_pag
        INNER JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id
        WHERE lev_pag.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewPageMenu->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewPageMenu(0)! Item de Menu da página, não encontrada no DB!</p>";
            $this->result = false;
        }
    }
/** ===========================================================================================
     * Recebe como parametro as informações que devem ser editadas
     * Instância a classe HELPER:AdmsValEmptyField(), validar se os campos foram preenchidos
     * instância o método:editColors para atualizar os dados no DB
     * @param array|null $data    -   @return void   */
    public function updatePageMenu(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editPageMenu();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método:editPageMenu para atualizar os dados no DB
     * @return void     */
    private function editPageMenu():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $updatePageMenu = new \App\adms\Models\helper\AdmsUpdate();
        $updatePageMenu->exeUpdate("adms_levels_pages", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($updatePageMenu->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Item de Menu da página Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editPageMenu())! Não foi possível Editar o Item de Menu da página!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $lists = new \App\adms\Models\helper\AdmsRead();
        $lists->fullRead("SELECT id AS id_itm, name AS name_itm FROM adms_items_menus ORDER BY name ASC");
        $registry['itm'] = $lists->getResult();

        $this->listRegistryAdd = ['itm' => $registry['itm']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }

}
