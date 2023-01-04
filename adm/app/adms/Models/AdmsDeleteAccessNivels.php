<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDeleteSitsUsers, para Apagar uma situação no banco de dados */
class AdmsDeleteAccessNivels
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
    public function deleteAccessNivels(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if(($this->viewAtualAccessNivels()) and ($this->checkStatusUsed())){
            $deleteAccessNivels = new \App\adms\Models\helper\AdmsDelete();
            $deleteAccessNivels->exeDelete("adms_access_levels", "WHERE id =:id", "id={$this->id}");

            if($deleteAccessNivels->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! O Nivel de Acesso APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! O Nivel de Acesso NÃO APAGADA!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewAtualAccessNivels():bool
    {
        $viewAtualAccessNivels = new \App\adms\Models\helper\AdmsRead();
        $viewAtualAccessNivels->fullRead("SELECT id FROM adms_access_levels WHERE id=:id AND order_levels >:order_levels LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->resultBd = $viewAtualAccessNivels->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)O Nivel de Acesso não encontrado!</p>";
            return false;
        }
    }
    /** ==============================================================================================
     * Método para verificar se existe algum usuário utilizando a situação q será apagada
     * @return void     */
    private function checkStatusUsed():bool
    {
        $checkStatusUsed = new \App\adms\Models\helper\AdmsRead();
        $checkStatusUsed->fullRead("SELECT id FROM adms_users WHERE access_level_id =:access_level_id LIMIT :limit", "access_level_id={$this->id}&limit=1",);
        if($checkStatusUsed->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! O Nivel de Acesso não pode ser apagada, pois existe um usuário o utilizando!</p>";
            return false;
        } else {
            return true;
        }
    }
}
