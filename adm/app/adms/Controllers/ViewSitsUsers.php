<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class ViewSitsUsers
{
    private array|null $data;
    private int|string|null $id;

    public function index(int|string|null $id = null):void
    {
        //verifica se existe um ID, se existir prossegue
        if(!empty($id)){
            //define o id como um inteiro o o atribui para o atributo:$this->id
            $this->id = (int) $id;
            //Instância a classe:AdmsViewSitsUsers() e cria um objeto:$resultSitsUsers
            $resultSitsUsers = new \App\adms\Models\AdmsViewSitsUsers();
            //usa o objeto para instânciar o método:viewSitsUsers(), que faz a consulta com o id 
            $resultSitsUsers->viewSitsUsers($this->id);
            //usa o objeto para instanciar o método:getResult() e verificar se o mesmo é true
            if($resultSitsUsers->getResult()){
                //se for, usa o objeto para instânciar o método:getResultBd() e atribuir o resultado do mesmo para uma nova posição no array do atributo:$this->data
                $this->data['viewSitsUsers'] = $resultSitsUsers->getResultBd();
                // var_dump($this->data['viewSitsUsers']);
                $this->loadViewSitsUsers();
            } else {
                $urlRedirect = URLADM."list-sits-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Nunhuma Situação encontrada!</p>";
            $urlRedirect = URLADM."list-sits-users/index";
            header("Location: $urlRedirect");
        }
    }
    /** ==============================================================================================
     * Método privado que intância a classe:ConfigView(parametro:endereço da view, dados) e o método:loadView() para executar a view
     * @return void     */
    private function loadViewSitsUsers()
    {
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-sits-users";

        $loadView = new \Core\ConfigView("adms/Views/sitsUsers/viewSitsUsers", $this->data);
        $loadView->loadView();
    }
}