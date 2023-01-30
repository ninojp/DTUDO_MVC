<?php
namespace App\sts\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller da pagina para apagar o Artigo da pagina Sobre Empresa */
class DeleteAboutPg
{
    /** @var integer|string|null - Recebe o ID(do Artigo) do registro    */
    private int|string|null $id;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $deleteAboutPg = new \App\sts\Models\StsDeleteAboutPg();
            $deleteAboutPg->deleteAboutPg($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (index(Controller))! Necessário selecionar o Artigo!</p>";
        }
        $urlRedirect = URLADM."list-about-pg/index";
        header("Location: $urlRedirect"); 
    }
}
