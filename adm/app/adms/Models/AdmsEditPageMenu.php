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
        $viewPageMenu->fullRead("SELECT id, adms_items_menu_id FROM adms_levels_pages WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewPageMenu->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewPageMenu(0)! Página no Item de menu, não encontrada no DB!</p>";
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
