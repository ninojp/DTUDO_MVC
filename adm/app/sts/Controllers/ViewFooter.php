<?php
namespace App\sts\Controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/****************************************************************************************************
 * Primeira classe do pacote STS do Curso PHPDevelopment 22/01/23
 * Classe Controllers para exibir a página inicial do site   */
class ViewFooter
{
    /** @var array|string|null - Recebe os dados do DB, da Models e os envia para a Views   */
    private array|string|null $data;

    public function index():void
    {
        $viewFooter = new \App\sts\Models\StsViewFooter();
        // Usa o objeto criado para instanciar o método:viewPageHomeTop() e obter os dados
        $viewFooter->viewFooter();
        // Cria a posi~ção no array:$this->data['viewHomeTop'] e os envia para a View
        $this->data['viewFooter'] = $viewFooter->getResultBdFooter();

        //-------------------------------------------------------------------------------------
        // implementação da apresentação dinâmica do menu sidebar
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "view-footer";

        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/footer/viewFooter", $this->data);
        $loadView->loadViewSts();
    }
}

