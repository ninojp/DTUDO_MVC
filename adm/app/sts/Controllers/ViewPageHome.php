<?php
namespace App\sts\Controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/****************************************************************************************************
 * Primeira classe do pacote STS do Curso PHPDevelopment 22/01/23
 * Classe Controllers para exibir a página inicial do site   */
class ViewPageHome
{
    /** @var array|string|null - Recebe os dados do DB, da Models e os envia para a Views   */
    private array|string|null $data;

    public function index():void
    {
        $viewPageHome = new \App\sts\Models\StsViewPageHome();
        // Usa o objeto criado para instanciar o método:viewPageHomeTop() e obter os dados
        $viewPageHome->viewPageHomeTop();
        // Cria a posi~ção no array:$this->data['viewHomeTop'] e os envia para a View
        $this->data['viewHomeTop'] = $viewPageHome->getResultBdTop();

        $viewPageHome->viewPageHomeServ();
        $this->data['viewHomeServ'] = $viewPageHome->getResultBdServ();

        $viewPageHome->viewPageHomeServPrime();
        $this->data['viewHomeServPrime'] = $viewPageHome->getResultBdServPrime();

        //-------------------------------------------------------------------------------------
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-page-home";

        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/viewPageHome", $this->data);
        $loadView->loadViewSts();
    }
}

