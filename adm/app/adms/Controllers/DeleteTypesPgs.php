<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(controller):DeleteTypesPgs para apagar um Tipo de pagina */
class DeleteTypesPgs
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
            $deleteSitsUsers = new \App\adms\Models\AdmsDeleteTypesPgs();
            $deleteSitsUsers->deleteTypePg($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar um Tipo de pagina!</p>";
        }
        $urlRedirect = URLADM."list-types-pgs/index";
        header("Location: $urlRedirect"); 
    }
}
