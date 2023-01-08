<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDeleteUsers, Apagar o usuário no banco de dados */
class AdmsDeletePages
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;

    /** @var array - Recebe os registros do banco de dados    */
    private array|null $resultBd;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     *  @return void      */
    public function deletePages(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if($this->viewPages()){
            $deleteUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_pages", "WHERE id =:id", "id={$this->id}");

            if($deleteUser->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-danger'>OK! Página APAGADA com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Página Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewPages():bool
    {
        $viewPages = new \App\adms\Models\helper\AdmsRead();
        $viewPages->fullRead("SELECT pgs.id, pgs.controller, pgs.metodo, pgs.menu_controller, pgs.menu_metodo, pgs.name_page, pgs.publish, pgs.adms_sits_pgs_id, pgs.adms_types_pgs_id, pgs.adms_groups_pgs_id, pgs.created FROM adms_pages AS pgs WHERE pgs.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewPages->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Pagina não encontrado!</p>";
            return false;
        }
    }
}
