<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller para apagar uma situação da Página */
class DeleteSitsPgs
{
    /** @var integer|string|null - Recebe o ID(da situação) do registro    */
    private int|string|null $id;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $deleteSitsPgs = new \App\adms\Models\AdmsDeleteSitsPgs();
            $deleteSitsPgs->deleteSitsPgs($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma Situação da Página!</p>";
        }
        $urlRedirect = URLADM."list-sits-pgs/index";
        header("Location: $urlRedirect");
    }
}
