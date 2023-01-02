<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe da controller da pagina para apagar o usuário */
class DeleteAccessNivels
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
            $delAccessNivels = new \App\adms\Models\AdmsDeleteAccessNivels();
            $delAccessNivels->deleteAccessNivels($this->id);
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Necessário selecionar um Nivel de Acesso !</p>";
        }
        $urlRedirect = URLADM."list-access-nivels/index";
        header("Location: $urlRedirect"); 
    }
}
