<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// Classe(Models) para vizualizar o nivel de acesso para o formulário novo usuário na pagina de login
class ViewLevelsForms
{
    private array|string|null $data;
    // private int|string|null $id;

    /** ===========================================================================================
     * @param integer|string|null|null $id -      @return void     */
    public function index():void
    {
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $viewLevelsForm = new \App\adms\Models\AdmsLevelsForms();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $viewLevelsForm->viewLevelsForms();
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($viewLevelsForm->getResult()){
                //se for, usa o objeto para instânciar o método:getResultBd() e atribuir o resultado do mesmo para uma nova posição no array do atributo:$this->data
                $this->data['viewLevelsForm'] = $viewLevelsForm->getResultBd();
                // var_dump($this->data['viewSitsUsers']);
                $this->loadViewLevelsForm();
            } else {
            // $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Página de configuração não encontrada!</p>";
            $urlRedirect = URLADM."dashboard/index";
            header("Location: $urlRedirect");
            }
    }
    /** ===========================================================================================
     * Método privado que intância a classe:ConfigView(parametro:endereço da view, dados) e o método:loadView() para executar a view
     * @return void     */
    private function loadViewLevelsForm()
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();
        
        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-levels-forms";

        $loadView = new \Core\ConfigView("adms/Views/levelsForm/viewLevelsForms", $this->data);
        $loadView->loadView();
    }
}