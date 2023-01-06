<?php
namespace App\adms\Models;
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use App\adms\Models\helper\AdmsValEmptyField;

/** Classe (Models):AdmsAddTypesPgs para adicionar novas paginas */
class AdmsAddTypesPgs
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;

    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;
    /** ============================================================================================
     * Recebe o resultado da query e atribui para o atributo:$this->result, Retorna true quando executado com sucesso e false quando houver erro  -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ==========================================================================================
     * Este método recebe os PARAMETROS:$data e depois atribui para o atributo:$this->data
     * Recebe os valores do fomulário.   -  @param array|null $data
     * Instância o Helper:AdmsValEmptyField para verificar se todos os campos foram preenchidos
     * Retorna false quando algun campo está vazio  -  @return void    */
    public function createTypePgs(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->addTypePgs();
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Cadastrar novo tipo de pagina no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function addTypePgs(): void
    {
        $this->data['created'] = date("Y-m-d H:i:s");
        var_dump($this->data);
        // foi usado para encontrar um erro, antes de instânciar a classe(foi comentada) abaixo
        // $this->result = false;
        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_types_pgs", $this->data);

        //verifica se existe o ultimo ID inserido
        if ($createUser->getResult()) {
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Tipo de pagina cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível cadastrar o Tipo de pagina</p>";
            $this->result = false;
        }
    }
    
}
