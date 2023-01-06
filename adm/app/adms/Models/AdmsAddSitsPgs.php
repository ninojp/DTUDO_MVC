<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
class AdmsAddSitsPgs
{
    private array|string|null $data;

    private bool $result;

    private array $resultListCor;

    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    public function createAddSitsPgs(array $data=null)
    {
        //recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valAddStitsPgs = new \App\adms\Models\helper\AdmsValEmptyField();
        $valAddStitsPgs->valField($this->data);
        //verifica, se o objeto:$valAddStitsUsers ainda está com true
        if($valAddStitsPgs->getResult()){
            //se sim, continua e instância o método:valInputSits()
            $this->valInputSits();
        } else {
            //se não, atribui false, para este método:createAddSitsUsers(), através do getResult()
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return void     */
    private function valInputSits():void
    {
        //instancia a classe para Validar se os caompos foram preenchidos
        $valImputEmpty = new \App\adms\Models\helper\AdmsValEmptyField();
        $valImputEmpty->valField($this->data);

        if($valImputEmpty->getResult()){
            $this->addSitsPgs();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function addSitsPgs():void
    {
        //usa a função:date() para receber a data e hora atual e atribui para o atributo:$this->data na posição:['created']
        $this->data['created'] = date('Y-m-d H:i:s');

        $addSitsPgs = new \App\adms\Models\helper\AdmsCreate();
        $addSitsPgs->exeCreate("adms_sits_pgs", $this->data);
        //Usa o objeto para instânciar o método:getResult(), e verificar, se o método retornou true, adicionou com sucesso
        if($addSitsPgs->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Situação da Página cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Situação da Página não cadastrado com sucesso</p>";
            $this->result = false;
        }
    }
    /** ==============================================================================
     * @return array     */
    public function listSelectCor():array
    {
        //instância a classe:AdmsRead() para fazer a consulta
        $listCor = new \App\adms\Models\helper\AdmsRead();
        //usa o método:fullRead() para fazer a query
        $listCor->fullRead("SELECT id AS idCor, name AS nameCor FROM adms_colors ORDER BY name ASC");
        //recebe o resultado da query e o atribui para um NOVO array:$resultCor['cor']
        $resultCor['cor'] = $listCor->getResult();
        //coloca no atributo:$this->resultListCor
        $this->resultListCor = ['cor' => $resultCor['cor']];
        // var_dump($this->resultListCor);
        return $this->resultListCor;
    }
    
}