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
        // echo "Acessou o administrativo da Página Home do site! <br>";

        $viewPageHome = new \App\sts\Models\StsViewPageHome();
        $viewPageHome->viewPageHome();

        // posição no array:$this->data['sidebarActive'], que define como ACTIVE no menu SIDEBAR
        $this->data['sidebarActive'] = "dashboard";

        $loadView = new \App\sts\core\ConfigViewSts("sts/Views/home/viewPageHome", $this->data);
        $loadView->loadViewSts();
    }
}

