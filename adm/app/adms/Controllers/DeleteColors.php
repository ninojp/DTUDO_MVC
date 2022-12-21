<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(controller) para apagar uma Cor no DB */
class DeleteColors
{
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $deleteColors = new \App\adms\Models\AdmsDeleteColors();
            $deleteColors->deleteColors($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma Cor !</p>";
        }
        $urlRedirect = URLADM."list-colors/index";
        header("Location: $urlRedirect"); 
    }
}
