<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsEditTypesPgs, Editar os dados do Tipo de pagina no banco de dados */
class AdmsEditItensMenu
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;
    
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;

    /** @var array|null - Recebe os campos que devem ser retirados da validação   */
    private array|null $dataExitVal;

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
    /** ============================================================================================
    */
    public function viewItensMenu(int $id):void
    {
        $this->id = $id;

        $viewItensMenu = new \App\adms\Models\helper\AdmsRead();
        $viewItensMenu->fullRead("SELECT id, name, icon, order_item_menu FROM adms_items_menus WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewItensMenu->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewItensMenu())! item de Menu não encontrada!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateItensMenu(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);

        //Remover o item da validação de campo vazio
        $this->dataExitVal['icon'] = $this->data['icon'];
        unset($this->data['icon']);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editItensMenu();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editItensMenu():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['nickname'] e coloca no atributo:$this->data['nickname'] para ser inserido no DB
        $this->data['icon'] = $this->dataExitVal['icon'];

        $updateItemMenu = new \App\adms\Models\helper\AdmsUpdate();
        $updateItemMenu->exeUpdate("adms_items_menus", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($updateItemMenu->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Item de Menu Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editItensMenu())! Não foi possível Editar o Item de Menu</p>";
            $this->result = false;
        }
    }
}
