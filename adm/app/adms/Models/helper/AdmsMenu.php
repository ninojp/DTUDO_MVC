<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe genérica para verificar as permissões de acesso ao Menu lateral sidebar */
class AdmsMenu
{
    /** @var array|null - Recebe os registros do banco de dados e retorna para a Controllers  */
    private array|null $resultBd;

    /** ===========================================================================================
     * 
     * @return array|null     */
    public function itemMenu(): array|bool|null
    {
        $listMenu = new \App\adms\Models\helper\AdmsRead();
        $listMenu->fullRead("SELECT lev_pag.id AS id_lev_pag, lev_pag.adms_page_id, pag.id AS id_pag, pag.menu_controller, pag.menu_metodo, pag.name_page, pag.icon FROM adms_levels_pages AS lev_pag INNER JOIN adms_pages AS pag ON pag.id=lev_pag.adms_page_id WHERE ((lev_pag.adms_access_level_id=:adms_access_level_id) AND (lev_pag.permission=1) AND (print_menu = 1)) ORDER BY lev_pag.order_level_page ASC", "adms_access_level_id=".$_SESSION['access_level_id']);

        $this->resultBd = $listMenu->getResult();
        if($this->resultBd) {
            return $this->resultBd;
        } else {
            return false;
        }
    }
}
