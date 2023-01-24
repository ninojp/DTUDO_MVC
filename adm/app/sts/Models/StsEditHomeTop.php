<?php
namespace App\sts\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe(Models):AdmsEditColors, para editar uma Cor no banco de dados */
class StsEditHomeTop
{
    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result = false;

    /** @var array - Recebe os dados do conteúdo do e-mail     */
    private array|null $resultBd;

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
    public function viewHomeTopBd():void
    {
        $viewHomeTopBd = new \App\adms\Models\helper\AdmsRead();
        $viewHomeTopBd->fullRead("SELECT id, title_one_top, title_two_top, title_three_top, link_btn_top, txt_btn_top, image_top FROM sts_homes_tops LIMIT :limit", "limit=1");

        $this->resultBd = $viewHomeTopBd->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (viewHomeTopBd())! Dados:sts_homes_tops não encontrada no DB!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Recebe como parametro as informações que devem ser editadas
     * Instância a classe HELPER:AdmsValEmptyField(), validar se os campos foram preenchidos
     * instância o método:editColors para atualizar os dados no DB
     * @param array|null $data    -   @return void   */
    public function veriFormHomeTop(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        
        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->mdEditHomeTop();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
    /** =============================================================================================
     * Método:editHomeTop para atualizar os dados no DB
     * @return void     */
    private function mdEditHomeTop():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");

        $updateHomeTop = new \App\adms\Models\helper\AdmsUpdate();
        $updateHomeTop->exeUpdate("sts_homes_tops", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($updateHomeTop->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! tabela(dados):sts_homes_tops Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro (editHomeTop())! Não foi possível Editar a tabela(dados):sts_homes_tops</p>";
            $this->result = false;
        }
    }

}
