<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(controllers) para apagar um E-mail de configuração */
class DeleteEmailConfs
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
            $deleteEmailConfs = new \App\adms\Models\AdmsDeleteEmailConfs();
            $deleteEmailConfs->deleteEmailConfs($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar um Usuário !</p>";
        }
        $urlRedirect = URLADM."list-email-confs/index";
        header("Location: $urlRedirect"); 
    }
}
