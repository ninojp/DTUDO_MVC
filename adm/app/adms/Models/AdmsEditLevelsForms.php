<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsEditLevelsForms, Editar configurações para novos usuários no banco de dados */
class AdmsEditLevelsForms
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
    public function viewLevelsForms(int $id):void
    {
        $this->id = $id;

        $viewLevelsForms = new \App\adms\Models\helper\AdmsRead();
        $viewLevelsForms->fullRead("SELECT alf.id, alf.adms_access_level_id, alf.adms_sits_user_id, alf.created, alf.modified, aal.name AS name_aal, asu.name AS name_asu
        FROM adms_levels_forms AS alf
        INNER JOIN adms_access_levels AS aal ON aal.id=alf.adms_access_level_id
        INNER JOIN adms_sits_users AS asu ON asu.id=alf.adms_sits_user_id
        WHERE alf.id=:id", "id={$this->id}");

        // $viewLevelsForms->fullRead("SELECT alf.id, alf.created, alf.modified, aal.name AS name_aal, asu.name AS name_asu
        // FROM adms_levels_forms AS alf
        // INNER JOIN adms_users AS usr ON usr.access_level_id=aal.id
        // INNER JOIN adms_access_levels AS aal ON aal.id=alf.adms_access_level_id
        // INNER JOIN adms_sits_users AS asu ON asu.id=alf.adms_sits_user_id
        // WHERE alf.id=:id AND aal.order_levels >:order_levels LIMIT :limit",
        // "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->resultBd = $viewLevelsForms->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewLevelsForms())! Registro:adms_levels_forms não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateLevelsForms(array $data = null):void
    {
        $this->data = $data;
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editLevelsForms();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }

    /** =============================================================================================
     * @return void     */
    private function editLevelsForms():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_levels_forms", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Configurções de novos usuários editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editLevelsForms())! Registro Não Editado!</p>";
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
