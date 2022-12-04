<?php
namespace App\adms\controllers;

class Logout
{

    /** ===================================================================================
     * Método para destruir os dados da sessão do usuario logado - @return void */
    public function index():void
    {
        //destrui os dados do usuario
        unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_user'], $_SESSION['user_nickname'], $_SESSION['user_email'], $_SESSION['user_image']);

        $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Logout realizado com sucesso</p>";
        $urlRedirect = URLADM."login/index";
        header("Location: $urlRedirect"); 
    }
}