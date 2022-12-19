<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
    // echo "adms/Controller/EditSitsUsers.php: <h1> Página(controller) Editar Situação</h1>";

class EditSitsUsers
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
        if ((!empty($id)) and (empty($this->dataForm['SendEditSitUser']))) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $atualSitsUsers = new \App\adms\Models\AdmsEditSitsUsers();
            $atualSitsUsers->viewSitsUsers($this->id);
            if($atualSitsUsers->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $atualSitsUsers->getResultBd();
                // var_dump($this->data['form']);
                $this->viewEditSitsUser();
            }else{
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editSitsUser();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function viewEditSitsUser(): void
    {
        $listSelect = new \App\adms\Models\AdmsEditSitsUsers();
        $this->data['selectCor'] = $listSelect->listSelectCor();
        // var_dump($this->data);

        //Instancio a classe:ConfigView() e crio o objeto:$loadView
        $loadView = new \Core\ConfigView("adms/Views/sitsUsers/editSitsUsers", $this->data);
        //Instancia o método:loadView() da classe:ConfigView
        $loadView->loadView();
    }
    /** =============================================================================================
     * @return void     */
    private function editSitsUser():void
    {
        if(!empty($this->dataForm['SendEditSitUser'])){
            unset($this->dataForm['SendEditSitUser']);
            $editUser = new \App\adms\Models\AdmsEditSitsUsers();
            $editUser->updateSits($this->dataForm);
            if($editUser->getResult()){
                $urlRedirect = URLADM . "view-sits-users/index/".$this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditSitsUser();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (necessário ID)Situação não encontrado!</p>";
            $urlRedirect = URLADM . "list-sits-users/index";
            header("Location: $urlRedirect");
        }
    }
}