<?php
namespace App\sts\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Controlles) para editar o conteúdo do toppo da pagina Home  */
class EditHomeServPrime
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
        if (empty($this->dataForm['SendEditHomeServPrime'])) {
            $viewHomeServPrimeBd = new \App\sts\Models\StsEditHomeServPrime();
            $viewHomeServPrimeBd->viewHomeServPrimeBd();
            if($viewHomeServPrimeBd->getResult()){
                //pega o resultado da query q está dentro de:getResultBd() e atribui para o atributo $data com a POSIÇÃO [FORM}
                $this->data['form'] = $viewHomeServPrimeBd->getResultBd();
                // var_dump($this->data['form']);
                $this->loadViewEditHomeServPrime();
            }else{
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }
        // Se usuário clicou no botão
        } else {
            $this->ctEditHomeServPrime();
        }
        
    }
    /** =============================================================================================
     * Instânciar a classe responsável em carregar a view e enviar os dados para a view
     * @return void     */
    private function loadViewEditHomeServPrime(): void
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-page-home";

        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/editHomeServPrime", $this->data);
        $loadView->loadViewSts();
    }
    /** =============================================================================================
     * @return void     */
    private function ctEditHomeServPrime():void
    {
        // Se for Diferente de vazio, o usuário clicou
        if(!empty($this->dataForm['SendEditHomeServPrime'])){
            unset($this->dataForm['SendEditHomeServPrime']);
            $editHomeServPrime = new \App\sts\Models\StsEditHomeServPrime();
            // $editColors->updateColors($this->dataForm);
            $editHomeServPrime->veriFormHomeServPrime($this->dataForm);
            if($editHomeServPrime->getResult()){
                $urlRedirect = URLADM . "view-page-home/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->loadViewEditHomeServPrime();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (ctEditHomeServPrime)! (ID)registro HomeServPrime não encontrado!</p>";
            $urlRedirect = URLADM . "view-page-home/index";
            header("Location: $urlRedirect");
        }
    }
}