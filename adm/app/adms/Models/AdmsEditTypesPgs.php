<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsEditTypesPgs, Editar os dados do Tipo de pagina no banco de dados */
class AdmsEditTypesPgs
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

    /** @var integer|string|null - Recebe o ID do registro    */
    private int|string|null $id;
    
    /** @var array|null - Recebe as informações do formulário     */
    private array|null $data;
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
    public function viewTypesPgs(int $id):void
    {
        $this->id = $id;

        $viewTypesPgs = new \App\adms\Models\helper\AdmsRead();
        $viewTypesPgs->fullRead("SELECT id, type, name, order_type_pg, obs FROM adms_types_pgs WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewTypesPgs->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Tipo de pagina não encontrada!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updateTypePg(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editTypePg();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * @return void     */
    private function editTypePg():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upTypePg = new \App\adms\Models\helper\AdmsUpdate();
        $upTypePg->exeUpdate("adms_types_pgs", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upTypePg->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Tipo da pagina Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível Editar o Tipo da pagina</p>";
            $this->result = false;
        }
    }
}
