<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Controllers):AdmsDeleteEmailConfs para Apagar um E-mail de configuração  */
class AdmsDeleteEmailConfs
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
    public function deleteEmailConfs(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if($this->viewAtualEmailConfs()){
            $deleteUser = new \App\adms\Models\helper\AdmsDelete();
            $deleteUser->exeDelete("adms_confs_emails", "WHERE id =:id", "id={$this->id}");

            if($deleteUser->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-danger'>OK! E-mail de configuração APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! E-mail de configuração Não APAGADO com sucesso!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewAtualEmailConfs():bool
    {
        $viewAtualEmailConfs = new \App\adms\Models\helper\AdmsRead();
        $viewAtualEmailConfs->fullRead("SELECT id FROM adms_confs_emails WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewAtualEmailConfs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! E-mail de configuração não encontrado!</p>";
            return false;
        }
    }
    
}
