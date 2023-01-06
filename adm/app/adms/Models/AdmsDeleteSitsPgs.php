<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDeleteSitsUsers, para Apagar uma situação no banco de dados */
class AdmsDeleteSitsPgs
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
    public function deleteSitsPgs(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if(($this->viewSitsUsers()) and ($this->checkStatusUsed())){
            $deleteSitsPgs = new \App\adms\Models\helper\AdmsDelete();
            $deleteSitsPgs->exeDelete("adms_sits_pgs", "WHERE id =:id", "id={$this->id}");

            if($deleteSitsPgs->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Situação da Página APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Situação da Página NÃO APAGADA!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewSitsUsers():bool
    {
        $viewSitsPgs = new \App\adms\Models\helper\AdmsRead();
        $viewSitsPgs->fullRead("SELECT id FROM adms_sits_pgs WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewSitsPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)Situação da Página não encontrado!</p>";
            return false;
        }
    }
    /** ==============================================================================================
     * Método para verificar se existe algum usuário utilizando a situação q será apagada
     * @return void     */
    private function checkStatusUsed():bool
    {
        $viewUserSits = new \App\adms\Models\helper\AdmsRead();
        $viewUserSits->fullRead("SELECT id FROM adms_pages WHERE adms_sits_pgs_id =:adms_sits_pgs_id LIMIT :limit", "adms_sits_pgs_id={$this->id}&limit=1",);
        if($viewUserSits->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)Situação da pagina não pode ser apagada, pois existe um usuário hà utilizando!</p>";
            return false;
        } else {
            return true;
        }
    }
}
