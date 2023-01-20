<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Controlles) para editar se o item deve ou não ser um Dropdown */
class EditDropdownMenu
{
    //Recebe o id do registro a ser editado
    private int|string|null $id;

    //Recebe o level de acesso
    private int|string|null $level;

    //Recebe o numero da página
    private int|string|null $pag;

    /** ==========================================================================================
     * Método para editar se o item(página) deve ou não ser um Dropdown
     * @param integer|string|null|null $id
     * @return void    */
    public function index(int|string|null $id=null):void
    {
        $this->id = $id;
        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        if((!empty($this->id)) and (!empty($this->level)) and (!empty($this->pag))){
            $editDropdownMenu = new \App\adms\Models\AdmsEditDropdownMenu();
            $editDropdownMenu->editDropdownMenu($this->id);
            // echo "Alterar Permissão";
            $urlRedirect = URLADM."list-permission/index/{$this->pag}?level={$this->level}";
            header("Location: $urlRedirect");
        } else {
            // echo "Erro: Alterar Permissão";
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro (index(controller))! Necessário selecionar a pagina</p>";
            $urlRedirect = URLADM."list-access-nivels/index";
            header("Location: $urlRedirect");
        }
    }
    
}