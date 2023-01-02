<?php
namespace App\adms\Models;
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use App\adms\Models\helper\AdmsValEmptyField;

/** Classe(Models):AdmsAddAccessNivels, para adicionar um novo Nivel de acesso */
class AdmsAddAccessNivels
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    private int|array $resultBd;

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
     * Instância o método:valInput para validar os dados dos campos. 
     * Retorna false quando algun campo está vazio  -  @return void    */
    public function createAccessNivels(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }
    /** ============================================================================================
     * Instânciar o Helper:validateAccessNivelsSingle para verificar se o Nivel não está cadastrado no DB, não permitido cadastro duplicado
     * Instânciar o Método:add quando não houver nenhum erro de preenchimento
     * Retorna a frase quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        //instancia a classe para validadr se o usuário já existe no DB
        $valUserSingleLogin = new \App\adms\Models\helper\AdmsValAccessNivelSingle();
        $valUserSingleLogin->validateAccessNivelsSingle($this->data['name']);

        if (($valUserSingleLogin->getResult())) {
            $this->addAccessNivels();
        } else {
            $this->result = false;
        }
    }
    /** ==============================================================================================
     * Método para verificar o ultimo codigo de acesso:order_levels adicionado no DB e adicionar o proximo com um numero a mais automaticamente
     * @return void      */
    private function viewLastAccessNivels()
    {
        $viewLastAccessNivels = new \App\adms\Models\helper\AdmsRead();
        $viewLastAccessNivels->fullRead("SELECT order_levels FROM adms_access_levels ORDER BY order_levels DESC LIMIT 1");

        $this->resultBd = $viewLastAccessNivels->getResult();
        if($this->resultBd){
            $this->data['order_levels'] = $this->resultBd[0]['order_levels'] + 1;
            return true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-danger'>Erro (viewLastAccessNivels())! Não foi possível cadastrar o Nivel de Acesso</p>";
            return false;
        }
    }
    /** ===========================================================================================
     * Cadastrar usuário no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function addAccessNivels(): void
    {
        if($this->viewLastAccessNivels()) {
            $this->data['created'] = date("Y-m-d H:i:s");
            // var_dump($this->data);
            // foi usado para encontrar um erro, antes de instânciar a classe(foi comentada) abaixo
            // $this->result = false;
            $createAccessNivels = new \App\adms\Models\helper\AdmsCreate();
            $createAccessNivels->exeCreate("adms_access_levels", $this->data);

            //verifica se existe o ultimo ID inserido
            if ($createAccessNivels->getResult()) {
                $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Nivel de Acesso cadastrado com sucesso</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (addAccessNivels())! Não foi possível cadastrar o Nivel de Acesso</p>";
                $this->result = false;
            }
        }
    }
}
