<?php
namespace App\adms\Models;
//verifica se está definido a constante(defida na index), se não estiver
if(!defined('$2y!10#OaHjLtRhiDTKNv(2022)TkYurzF')){ header("Location: https://localhost/dtudo/public/"); }
use App\adms\Models\helper\AdmsValEmptyField;

/** Classe (models):AdmsAddPages para cadastrar novas Páginas  */
class AdmsAddPages
{
    //recebido como parametro através do método:create() e colocado neste atributo
    private array|null $data;

    // Recebe do método:getResult() o valor:(true or false), q será atribuido aqui
    private bool $result;

    private array $listRegistryAdd;

    private array $dataExitVal;

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
    public function createPage(array $data = null)
    {
        //atribui o parametro:$data para o atributo:$this->data
        $this->data = $data;
        // var_dump($this->data);

        //atribui o valor que está no campo OBS para o atributo:$dataExitVal
        $this->dataExitVal['obs'] = $this->data['obs'];
        $this->dataExitVal['icon'] = $this->data['icon'];
        //Destroi o valor que está no atributo:$this->data['nickname']
        // unset($this->data['nickname']);
        unset($this->data['obs'], $this->data['icon']);

        //instancia a classe:AdmsValEmptyField e cria o objeto:$valEmptyField
        $valEmptyField = new AdmsValEmptyField();
        //usa o objeto:$valEmptyField para instanciar o método:valField() para validar os dados dentro do atributo:$this->data
        $valEmptyField->valField($this->data);
        //verifica se o método:getResult() retorna true, se sim significa q deu tudo certo se não aprensenta o Erro
        if ($valEmptyField->getResult()) {
            $this->addPage();
        } else {
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * Cadastrar usuário no DB  - @return void
     * Retorna true quando cadastrar com sucesso e false quando não cadastrar   */
    private function addPage(): void
    {
        $this->data['created'] = date("Y-m-d H:i:s");
        // var_dump($this->data);
        //Atribui NOVAMENTE(recupera) o valor q está no atributo:$this->dataExitval['obs'] e coloca no atributo:$this->data['obs'] para ser inserido no DB
        $this->data['obs'] = $this->dataExitVal['obs'];
        $this->data['icon'] = $this->dataExitVal['icon'];
        
        // foi usado para encontrar um erro, antes de instânciar a classe(foi comentada) abaixo
        // $this->result = false;
        $createPage = new \App\adms\Models\helper\AdmsCreate();
        $createPage->exeCreate("adms_pages", $this->data);

        //verifica se existe o ultimo ID inserido
        if ($createPage->getResult()) {
            $_SESSION['msg'] = "<p class='alert alert-success'>Ok! Página cadastrada com sucesso</p>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p class='alert alert-warning'>Erro! Não foi possível cadastrar a Página</p>";
            $this->result = false;
        }
    }
    /** ===========================================================================================
     * @return array     */
    public function listSelect():array
    {
        //listar os dados das tabelas, para utilizar no select da view de adição de Página
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
