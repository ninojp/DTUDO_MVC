<?php
namespace App\sts\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Controlles) para editar o conteúdo do toppo da pagina Home  */
class EditPgContact
{
    //Envia os dados a serem editados no formulário da view
    private array|string|null $data = [];
    //recebe os dados do formulário da view
    private array|null $dataForm;

    /** ============================================================================================
     * Método para editar o conteúdo do toppo da pagina Home
     * Se o usuário nãop clicou no botão editar, instância a Models para recuperar as informções no DB, se encontrar instância o método:viewEditHomeTop. Se não existir redireciona para o visualizar conteúdo da pagina.
     *  @return void     */
    public function index():void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        // var_dump($this->dataForm);
        //Se for vazio, ou seja usuário não clicou no botão
        if (empty($this->dataForm['SendEditPgcontact'])) {
            $viewPgcontact = new \App\sts\Models\StsEditPgContact();
            $viewPgcontact->viewPgContact();
            if($viewPgcontact->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewPgcontact->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditPgContact();
            }else{
                $urlRedirect = URLADM . "view-pg-contact/index";
                header("Location: $urlRedirect");
            }
        // Se usuário clicou no botão
        } else {
            $this->ctEditPgContact();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditPgContact(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-pg-contact";

        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/contact/editPgContact", $this->data);
        $loadView->loadViewSts();
    }
    /** =============================================================================================
     * @return void     */
    private function ctEditPgContact():void
    {
        // Se for Diferente de vazio, o usuário clicou
        if(!empty($this->dataForm['SendEditPgcontact'])){
            unset($this->dataForm['SendEditPgcontact']);
            $editHomeServ = new \App\sts\Models\StsEditPgContact();
            // $editColors->updateColors($this->dataForm);
            $editHomeServ->veriFormPgContact($this->dataForm);
            if($editHomeServ->getResult()){
                $urlRedirect = URLADM . "view-pg-contact/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditPgContact();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (ctEditPgContact(controller))! (ID)registro HomeServ não encontrado!</p>";
            $urlRedirect = URLADM . "view-pg-contact/index";
            header("Location: $urlRedirect");
        }
    }
}