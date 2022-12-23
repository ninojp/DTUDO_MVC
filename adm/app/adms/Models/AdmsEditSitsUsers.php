<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsEditSitsUsers, Editar Situação no banco de dados */
class AdmsEditSitsUsers
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
    public function viewSitsUsers(int $id):void
    {
        $this->id = $id;

        $viewUsers = new \App\adms\Models\helper\AdmsRead();
        $viewUsers->fullRead("SELECT id, name, adms_color_id FROM adms_sits_users WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUsers->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Situação não encontrada!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateSits(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->valInputSits();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return void     */
    private function valInputSits():void
    {
        //instancia a classe para Validar a situação
        $valSits = new \App\adms\Models\helper\AdmsValSits();
        //apenas para teste, filtro simples FILTER_DEFAULT, o prof não fez este filtro
        $valSits->validateSits($this->data['name']);

        if($valSits->getResult()){
            $this->editSitsUsers();
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editSitsUsers():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upSitsUser = new \App\adms\Models\helper\AdmsUpdate();
        $upSitsUser->exeUpdate("adms_sits_users", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upSitsUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Situação Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível Editar a Situação</p>";
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
