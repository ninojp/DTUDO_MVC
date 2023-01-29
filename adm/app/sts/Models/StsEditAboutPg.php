<?php
namespace App\sts\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsViewUsers, Editar o usuário no banco de dados */
class StsEditAboutPg
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
    public function viewEditAboutPg(int $id):void
    {
        $this->id = $id;

        $viewEditAboutPg = new \App\adms\Models\helper\AdmsRead();
        $viewEditAboutPg->fullRead("SELECT sac.id, sac.title, sac.description, sac.image, sac.sts_situation_id, sit.name FROM sts_abouts_companies AS sac INNER JOIN sts_situations AS sit ON sit.id=sac.sts_situation_id WHERE sac.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewEditAboutPg->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewEditAboutPg(Models))! Registro não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateAboutPg(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        //o codigo abaixo é apenas para retirar um campo da VALIDAÇÃO
        //atribui o valor que está no campo NICKNAME para o atributo:$dataExitVal
        $this->dataExitVal['image'] = $this->data['image'];
        //Destroi o valor que está no atributo:$this->data['nickname']
        unset($this->data['image']);
        // var_dump($this->dataExitVal);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editAboutPg();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editAboutPg():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['nickname'] e coloca no atributo:$this->data['nickname'] para ser inserido no DB
        $this->data['image'] = $this->dataExitVal['image'];
        // $this->data['name'] = $this->dataExitVal['name'];
        // var_dump($this->data);
        // $this->result = false;TESTE

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("sts_abouts_companies", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upUser->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Registro Editado com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editAboutPg(Models))! Não foi possível Editar o Registro</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_sit, name name_sit FROM sts_situations ORDER BY name ASC");
        $registry['sit'] = $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
