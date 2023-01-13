<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class SyncPagesNivels
{
    /** ===================================================================================
     * Método que instancia a classe responsavel em sincronizar o nivel de acesso e as paginas
     * @return void */
    public function index():void
    {
        
        $syncPagesNivels = new \App\adms\Models\AdmsSyncPagesNivels();
        $syncPagesNivels->syncPagesNivels();
        
        $urlRedirect = URLADM."list-access-nivels/index";
        header("Location: $urlRedirect");
    }
}