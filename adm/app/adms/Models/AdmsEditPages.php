<?php
namespace App\adms\Models;
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
/** Classe:AdmsEditPages, Editar as paginas no banco de dados */
class AdmsEditPages
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
    public function viewPages(int $id):void
    {
        $this->id = $id;

        $viewPages = new \App\adms\Models\helper\AdmsRead();
        $viewPages->fullRead("SELECT pgs.id, pgs.controller, pgs.metodo, pgs.menu_controller, pgs.menu_metodo, pgs.name_page, pgs.publish, pgs.icon, pgs.obs, pgs.adms_sits_pgs_id, pgs.adms_types_pgs_id, pgs.adms_groups_pgs_id, pgs.created, pgs.modified, asp.name AS name_asp, atp.type AS type_atp, agp.name AS name_agp FROM adms_pages AS pgs INNER JOIN adms_sits_pgs AS asp ON asp.id=pgs.adms_sits_pgs_id INNER JOIN adms_types_pgs AS atp ON atp.id=pgs.adms_types_pgs_id INNER JOIN adms_groups_pgs AS agp ON agp.id=pgs.adms_groups_pgs_id WHERE pgs.id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewPages->getResult();
        if($this->resultBd){
            // var_dump($this->resultBd);
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Pagina não encontrado!</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @param array|null $data
     * @return void   */
    public function updatePage(array $data = null):void
    {
        $this->data = $data;
        // var_dump($this->data);
        //o codigo abaixo é apenas para retirar um campo da VALIDAÇÃO
        //atribui o valor que está no campo OBS para o atributo:$dataExitVal
        $this->dataExitVal['obs'] = $this->data['obs'];
        $this->dataExitVal['icon'] = $this->data['icon'];
        //Destroi o valor que está no atributo:$this->data['nickname']
        // unset($this->data['nickname']);
        unset($this->data['obs'], $this->data['icon']);
        // var_dump($this->data);
        // var_dump($this->dataExitVal);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->editPage();
            // $this->result = false;
        } else {
            $this->result = false;
        }
    }
     /** ========================================================================================
     * @return void     */
    private function editPage():void
    {
        // var_dump($this->data);
        $this->data['modified'] = date("Y-m-d H:i:s");
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['obs'] e coloca no atributo:$this->data['obs'] para ser inserido no DB
        $this->data['obs'] = $this->dataExitVal['obs'];
        $this->data['icon'] = $this->dataExitVal['icon'];
        // var_dump($this->data);
        // $this->result = false;TESTE

        $upPage = new \App\adms\Models\helper\AdmsUpdate();
        $upPage->exeUpdate("adms_pages", $this->data, "WHERE id=:id", "id={$this->data['id']}");

        if($upPage->getResult()){
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Página Editada com sucesso</p>";
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível Editar a página</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        $lists = new \App\adms\Models\helper\AdmsRead();
        $lists->fullRead("SELECT astp.id AS id_sit, astp.name AS name_sit FROM adms_sits_pgs AS astp ORDER BY astp.name ASC");
        $registry['sit'] = $lists->getResult();

        $lists->fullRead("SELECT atp.id AS id_atp, atp.type AS type_atp FROM adms_types_pgs AS atp ORDER BY atp.type ASC");
        $registry['atp'] = $lists->getResult();
        
        $lists->fullRead("SELECT agp.id AS id_agp, agp.name AS name_agp FROM adms_groups_pgs AS agp ORDER BY agp.name ASC");
        $registry['agp'] = $lists->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'atp' => $registry['atp'], 'agp' => $registry['agp']];
        // var_dump($this->listRegistryAdd);

        return $this->listRegistryAdd;
    }
}
