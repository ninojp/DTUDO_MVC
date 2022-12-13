<?php

namespace App\adms\Models;

use App\adms\Models\helper\AdmsCreate;
use App\adms\Models\helper\AdmsValEmail;
use App\adms\Models\helper\AdmsValEmptyField;

/** Classe:AdmsNewUser, é filha(Herda) da classe:AdmsConn(abstrata responsável pela conexão) */
class AdmsAddUsers
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    private array $listRegistryAdd;

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
    public function create(array $data = null)
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
     * Instânciar o Helper:AdmsValEmail para verificar se o e-mail é válido
     * Instânciar o Helper:AdmsValEmailSingle para verificar se o e-mail não está cadastrado no DB, não permitido cadastro com e-mail duplicado.
     * Instânciar o Helper:validatePassword para validar a senha
     * Instânciar o Helper:validateUserSingleLogin para verificar se o usuário não está cadastrado no DB, não permitido cadastro duplicado
     * Instânciar o Método:add quando não houver nenhum erro de preenchimento
     * Retorna flase quando houver algun erro  -  @return void  */
    private function valInput(): void
    {
        //instancia a classe para Validar o email
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        //instancia a classe para Validar se o email já existe no banco de dados
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email']);

        //instancia a classe para Validar a senha
        $valPassword = new \App\adms\Models\helper\AdmsValPassword();
        $valPassword->validatePassword($this->data['password']);

        //instancia a classe para validadr se o usuário já existe no DB
        $valUserSingleLogin = new \App\adms\Models\helper\AdmsValUserSingle();
        $valUserSingleLogin->validateUserSingle($this->data['user']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valPassword->getResult()) and ($valUserSingleLogin->getResult())) {
            $this->add();
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Cadastrar usuário no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function add(): void
    {
        // Criptografar a senha
        $this->data['password'] = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $this->data['conf_email'] = password_hash($this->data['password'].date("Y-m-d H:i:s"), PASSWORD_DEFAULT);
        $this->data['created'] = date("Y-m-d H:i:s");
        // var_dump($this->data);
        // foi usado para encontrar um erro, antes de instânciar a classe(foi comentada) abaixo
        // $this->result = false;
        $createUser = new \App\adms\Models\helper\AdmsCreate();
        $createUser->exeCreate("adms_users", $this->data);

        //verifica se existe o ultimo ID inserido
        if ($createUser->getResult()) {
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário cadastrado com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível cadastrar o usuário</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_sit, name name_sit FROM adms_sits_users ORDER BY name ASC");
        $registry['sit'] = $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
