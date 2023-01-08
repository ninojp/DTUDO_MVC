<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsViewUsers, Visualizar os usuários no banco de dados */
class AdmsViewPages
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function viewPages(int $id):void
    {
        $this->id = $id;

        $viewPages = new \App\adms\Models\helper\AdmsRead();
        $viewPages->fullRead("SELECT pgs.id, pgs.controller, pgs.metodo, pgs.menu_controller, pgs.menu_metodo, pgs.name_page, pgs.publish, pgs.icon, pgs.obs, pgs.adms_sits_pgs_id, pgs.adms_types_pgs_id, pgs.adms_groups_pgs_id, pgs.created, pgs.modified, asp.name AS name_asp, atp.type AS type_atp, agp.name AS name_agp FROM adms_pages AS pgs INNER JOIN adms_sits_pgs AS asp ON asp.id=pgs.adms_sits_pgs_id INNER JOIN adms_types_pgs AS atp ON atp.id=pgs.adms_types_pgs_id INNER JOIN adms_groups_pgs AS agp ON agp.id=pgs.adms_groups_pgs_id  WHERE pgs.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewPages->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Página não encontrado!</p>";
            $this->result = false;
        }
    }
}
