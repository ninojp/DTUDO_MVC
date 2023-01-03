<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsViewUsers, Editar o usuário no banco de dados */
class AdmsEditUsers
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;
    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;
    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;
    /** @var array|null - Recebe os campos que devem ser retirados da validação   */
    private array|null $dataExitVal;

    private array $listRegistryAdd;

    /** ============================================================================================
     * Retorna TRUE se executar o processo com sucesso, FALSE quando houver erro e atribui para o atributo:$this->result    -  @return void     */
    function getResult():bool
    {
        return $this->result;
    }
    /** ============================================================================================
     * Retorna os detalhes do registro
     * @return void     */
    function getResultBd():array|null
    {
        return $this->resultBd;
    }
    /** ============================================================================================
    */
    public function viewUsers(int $id):void
    {
        $this->id = $id;

        $viewUsers = new \App\adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT id, name, nickname, email, user, adms_sits_user_id, access_level_id FROM adms_users WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Usuário não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function update(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        //o codigo abaixo é apenas para retirar um campo da VALIDAÇÃO
        //atribui o valor que está no campo NICKNAME para o atributo:$dataExitVal
        $this->dataExitVal['nickname'] = $this->data['nickname'];
        // $this->dataExitVal['name'] = $this->data['name'];
        // unset($this->data['nickname'], $this->data['name']);
        //Destroi o valor que está no atributo:$this->data['nickname']
        unset($this->data['nickname']);
        // var_dump($this->data);
        // var_dump($this->dataExitVal);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->valInput();
            // $this->result = false;
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

        //validar se o email é único
        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email'], true, $this->data['id']);

        //validar se o USER é único
        $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingle();
        $valUserSingle->validateUserSingle($this->data['user'], true, $this->data['id']);

        if (($valEmail->getResult()) and ($valEmailSingle->getResult()) and ($valUserSingle->getResult())) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function edit():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['nickname'] e coloca no atributo:$this->data['nickname'] para ser inserido no DB
        $this->data['nickname'] = $this->dataExitVal['nickname'];
        // $this->data['name'] = $this->dataExitVal['name'];
        // var_dump($this->data);
        // $this->result = false;TESTE

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Usuário Editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível Editar o usuário</p>";
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

        //listar o nivel de acesso da tabela:adms_access_levels para utilizar no select da view de adição de usuário, só pode adicionar usuários com NIVEL de ACESSO inferior aos dele
        $list->fullRead("SELECT id id_lev, name name_lev FROM adms_access_levels WHERE order_levels >:order_levels ORDER BY name ASC", "order_levels=".$_SESSION['order_levels']);
        $registry['lev'] = $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'lev' => $registry['lev']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
