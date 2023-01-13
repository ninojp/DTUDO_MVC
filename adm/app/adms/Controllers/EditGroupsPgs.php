<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class EditgroupsPgs
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
        if ((!empty($id)) and (empty($this->dataForm['SendEditGroupsPgs']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $atualGroupsPgs = new \App\adms\Models\AdmsEditGroupsPgs();
            $atualGroupsPgs->viewGroupsPgs($this->id);
            if($atualGroupsPgs->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualGroupsPgs->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditGroupsPgs();
            }else{
                $urlRedirect = URLADM . "list-groups-pgs/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editGroupsPgs();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditGroupsPgs(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-groups-pgs";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \Core\ConfigView("adms/Views/pages/editGroupsPgs", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    /** =============================================================================================
     * @return void     */
    private function editGroupsPgs():void
    {
        if(!empty($this->dataForm['SendEditGroupsPgs'])){
            unset($this->dataForm['SendEditGroupsPgs']);
            $editGroupsPgs = new \App\adms\Models\AdmsEditGroupsPgs();
            $editGroupsPgs->updateGroupsPgs($this->dataForm);
            if($editGroupsPgs->getResult()){
                $urlRedirect = URLADM . "view-groups-pgs/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditGroupsPgs();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)Grupo de Pagina não encontrado!</p>";
            $urlRedirect = URLADM . "list-groups-pgs/index";
            header("Location: $urlRedirect");
        }
    }
}