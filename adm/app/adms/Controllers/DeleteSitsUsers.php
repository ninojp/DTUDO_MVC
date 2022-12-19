<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller da pagina para apagar o usuário */
class DeleteSitsUsers
{
    /** @var integer|string|null - Recebe o ID(do usuário) do registro    */
    private int|string|null $id;

    /** ===================================================================================
     * 
     * @return void */
    public function index(int|string|null $id = null): void
    {
        if (!empty($id)) {
            $this->id = (int) $id;
            // var_dump($this->id);
            $deleteUser = new \App\adms\Models\AdmsDeleteUsers();
            $deleteUser->deleteUsers($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar um Usuário !</p>";
        }
        $urlRedirect = URLADM."list-users/index";
        header("Location: $urlRedirect"); 
    }
}
