<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller para apagar uma situação */
class DeleteSitsUsers
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
            $deleteUser = new \App\adms\Models\AdmsDeleteSitsUsers();
            $deleteUser->deleteSitsUsers($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar uma Situação !</p>";
        }
        $urlRedirect = URLADM."list-sits-users/index";
        header("Location: $urlRedirect"); 
    }
}
