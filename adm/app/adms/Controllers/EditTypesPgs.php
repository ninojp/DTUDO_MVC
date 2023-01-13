<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
    // echo "adms/Controller/EditSitsUsers.php: <h1> Página(controller) Editar Situação</h1>";

class EditTypesPgs
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
        if ((!empty($id)) and (empty($this->dataForm['SendEditTypesPgs']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $atualTypesPgs = new \App\adms\Models\AdmsEditTypesPgs();
            $atualTypesPgs->viewTypesPgs($this->id);
            if($atualTypesPgs->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualTypesPgs->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditTypesPgs();
            }else{
                $urlRedirect = URLADM . "list-types-pgs/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editTypesPgs();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditTypesPgs(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "edit-types-pgs";

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \Core\ConfigView("adms/Views/pages/editTypesPgs", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    /** =============================================================================================
     * @return void     */
    private function editTypesPgs():void
    {
        if(!empty($this->dataForm['SendEditTypesPgs'])){
            unset($this->dataForm['SendEditTypesPgs']);
            $editTypesPgs = new \App\adms\Models\AdmsEditTypesPgs();
            $editTypesPgs->updateTypePg($this->dataForm);
            if($editTypesPgs->getResult()){
                $urlRedirect = URLADM . "view-types-pgs/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditTypesPgs();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)Tipo de Pagina não encontrado!</p>";
            $urlRedirect = URLADM . "list-types-pgs/index";
            header("Location: $urlRedirect");
        }
    }
}