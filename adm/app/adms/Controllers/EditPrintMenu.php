<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Controlles) para editar o imprimir item de menu */
class EditPrintMenu
{
    //Recebe o id do registro a ser editado
    private int|string|null $id;

    //Recebe o level de acesso
    private int|string|null $level;

    //Recebe o numero da página
    private int|string|null $pag;

    /** ==========================================================================================
     * Método para editar o imprimir item de menu
     * @param integer|string|null|null $id
     * @return void    */
    public function index(int|string|null $id=null):void
    {
        $this->id = $id;
        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        if((!empty($this->id)) and (!empty($this->level)) and (!empty($this->pag))){
            $editPrintMenu = new \App\adms\Models\AdmsEditPrintMenu();
            $editPrintMenu->editPrintMenu($this->id);
            // echo "Alterar Permissão";
            $urlRedirect = URLADM."list-permission/index/{$this->pag}?level={$this->level}";
            header("Location: $urlRedirect");
        } else {
            // echo "Erro: Alterar Permissão";
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro (index(controller))! Necessário selecionar o item de menu</p>";
            $urlRedirect = URLADM."list-access-nivels/index";
            header("Location: $urlRedirect");
        }
    }
    
}