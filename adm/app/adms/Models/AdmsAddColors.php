<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
// Classe(Models) para verificar se já existe, senão, cadastrar uma nova Cor
class AdmsAddColors
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
    public function createAddColors(array $data=null)
    {
        //recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valAddColors = new \App\adms\Models\helper\AdmsValEmptyField();
        $valAddColors->valField($this->data);
        //verifica, se o objeto:$valAddColors ainda está com true
        if($valAddColors->getResult()){
            //se sim, continua e instância o método:valInputSits()
            $this->valInputColors();
        } else {
            //se não, atribui false, para este método:createAddSitsUsers(), através do getResult()
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Método para validadar se já existe uma car com o mesmo nome
     * @return void     */
    private function valInputColors():void
    {
        //validação de nome unico, para não haver outro com mesmo nome
        $valSitsSingle = new \App\adms\Models\helper\AdmsValColorsSingle();
        $valSitsSingle->validateColorsSingle($this->data['name']);

        if($valSitsSingle->getResult()){
            $this->addColors();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function addColors():void
    {
        //usa a função:date() para receber a data e hora atual e atribui para o atributo:$this->data na posição:['created']
        $this->data['created'] = date('Y-m-d H:i:s');

        $addColors = new \App\adms\Models\helper\AdmsCreate();
        $addColors->exeCreate("adms_colors", $this->data);
        //Usa o objeto para instânciar o método:getResult(), e verificar, se o método retornou true, adicionou com sucesso
        if($addColors->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Cor cadastrada com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro! Cor não cadastrado com sucesso</p>";
            $this->result = false;
        }
    }
    
}