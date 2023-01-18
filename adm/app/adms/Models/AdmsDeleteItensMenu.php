<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDeleteUsers, Apagar o usuário no banco de dados */
class AdmsDeleteItensMenu
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
    public function deleteItensMenu(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if($this->viewItemMenu()){
            $deletetemMenu = new \App\adms\Models\helper\AdmsDelete();
            $deletetemMenu->exeDelete("adms_items_menus", "WHERE id =:id", "id={$this->id}");

            if($deletetemMenu->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Item de Menu APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Item de Menu Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewItemMenu():bool
    {
        $viewItemMenu = new \App\adms\Models\helper\AdmsRead();
        $viewItemMenu->fullRead("SELECT aim.id FROM adms_items_menus AS aim
        WHERE aim.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewItemMenu->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewItemMenu())! Item de Menu não encontrado!</p>";
            return false;
        }
    }
}
