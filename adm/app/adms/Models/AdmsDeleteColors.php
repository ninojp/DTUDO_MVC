<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsDeleteSitsUsers, para Apagar uma situação no banco de dados */
class AdmsDeleteColors
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
    public function deleteColors(int $id):void
    {
        $this->id = (int) $id;
        // var_dump($this->id);
        if(($this->viewAtualColors()) and ($this->checkStatusUsed())){
            $deleteColor = new \App\adms\Models\helper\AdmsDelete();
            $deleteColor->exeDelete("adms_colors", "WHERE id =:id", "id={$this->id}");

            if($deleteColor->getResult()){
                $_SESSION['msg'] = "<p class='alert alert-warning'>OK! Cor APAGADO com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Cor NÃO APAGADA!!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
    * @return boolean   */
    private function viewAtualColors():bool
    {
        $viewAtualColors = new \App\adms\Models\helper\AdmsRead();
        $viewAtualColors->fullRead("SELECT id FROM adms_colors WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewAtualColors->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! (ID)Cor não encontrado!</p>";
            return false;
        }
    }
    /** ==============================================================================================
     * Método para verificar se existe algum usuário utilizando a situação q será apagada
     * @return void     */
    private function checkStatusUsed():bool
    {
        $viewColorUsed = new \App\adms\Models\helper\AdmsRead();
        $viewColorUsed->fullRead("SELECT id FROM adms_sits_users WHERE adms_color_id =:adms_color_id LIMIT :limit", "adms_color_id={$this->id}&limit=1",);
        if($viewColorUsed->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! A Cor não pode ser apagada, pois existe uma Situação há utilizando!</p>";
            return false;
        } else {
            return true;
        }
    }
}
