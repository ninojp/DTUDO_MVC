<?php
namespace App\adms\controllers;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// Classe(Controllers) para Alterar a ordem do Item de menu(sidebar)
class OrderPageMenu
{
    //Recebe o id do registro a ser editado
    private int|string|null $id;

    //Recebe o level de acesso
    private int|string|null $level;

    //Recebe o numero da página
    private int|string|null $pag;

    /** =============================================================================================
     * Alterar a ordem do Item de menu
     * Recebe como parametro o id que será usado na pesquisa das informações no DB e instância a Models:...(), Após editado retorna MSG e redireciona para o ... 
     * @param integer|string|null|null $id,  @return void     */
    public function index(int|string|null $id = null):void
    {
        $this->id = (int) $id;
        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        //verifica se recebeu o ID, nivel de acesso(level) e pagina atual(pag) se recebeu prossegue
        if((!empty($this->id)) and (!empty($this->level)) and (!empty($this->pag))){
            $editOrderPageMenu = new \App\adms\Models\AdmsOrderPageMenu();
            $editOrderPageMenu->orderPageMenu($this->id);
            // echo "Alterar Permissão";
            $urlRedirect = URLADM."list-permission/index/{$this->pag}?level={$this->level}";
            header("Location: $urlRedirect");
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro (index(controller))! Necessário selecionar Item de Menu</p>";
            $urlRedirect = URLADM."list-access-nivels/index";
            header("Location: $urlRedirect");
        }
    }
}