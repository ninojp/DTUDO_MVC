<?php
namespace App\adms\Models\helper;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe genérica para verificar as permissões de acesso a os botões */
class AdmsButton
{
    /** @var array|null - Recebe os registros do banco de dados e retorna para a Models  */
    private array|null $result;

    /** @var array|null - Recebe o array de dados   */
    private array|null $data;

    /** ============================================================================================
     * @return array|null     */
    function getResult(): array|null
    {
        return $this->result;
    }
    /** ===========================================================================================
     * 
     * @return array|null     */
    public function buttonPermission(array|null $data): array|null
    {
        $this->data = $data;
        // var_dump($this->data);

        foreach($this->data as $key => $button){
            // var_dump($key);
            // var_dump($button);
            extract($button);

            $viewButton = new \App\adms\Models\helper\AdmsRead();
            $viewButton->fullRead("SELECT pag.id FROM adms_pages AS pag INNER JOIN adms_levels_pages AS lev_pag ON lev_pag.adms_page_id=pag.id WHERE pag.menu_controller=:menu_controller AND pag.menu_metodo =:menu_metodo AND lev_pag.permission=1 AND lev_pag.adms_access_level_id=:adms_access_level_id LIMIT :limit", "menu_controller=$menu_controller&menu_metodo=$menu_metodo&adms_access_level_id=".$_SESSION['access_level_id']."&limit=1");
            // Verifica se obteve resultado, através do objeto:viewButton
            if($viewButton->getResult()){
                // no array com a respectiva posição recebe true, pode acessar
                $this->result[$key] = true;
            } else {
                $this->result[$key] = false;
            }
        }
        return $this->result;
    }

}
