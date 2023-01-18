<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class EditItensMenu
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;
    //Recebe o id do registro a ser editado
    private int|string|null $id;

    public function index(int|string|null $id=null):void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        if ((!empty($id)) and (empty($this->dataForm['SendEditItensMenu']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $viewItensMenu = new \App\adms\Models\AdmsEditItensMenu();
            $viewItensMenu->viewItensMenu($this->id);
            if($viewItensMenu->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewItensMenu->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditItensMenu();
            }else{
                $urlRedirect = URLADM . "list-itens-menu/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editItensMenu();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditItensMenu(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-itens-menu";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \Core\ConfigView("adms/Views/itensmenu/editItensMenu", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    /** =============================================================================================
     * @return void     */
    private function editItensMenu():void
    {
        if(!empty($this->dataForm['SendEditItensMenu'])){
            unset($this->dataForm['SendEditItensMenu']);
            $editItensMenu = new \App\adms\Models\AdmsEditItensMenu();
            $editItensMenu->updateItensMenu($this->dataForm);
            if($editItensMenu->getResult()){
                $urlRedirect = URLADM . "view-itens-menu/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditItensMenu();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editItensMenu())! (ID)Item de Menu não encontrado!</p>";
            $urlRedirect = URLADM . "list-itens-menu/index";
            header("Location: $urlRedirect");
        }
    }
}